<?php declare(strict_types = 1);

namespace Clickstorm\CsFileMetaFill\Hooks;

/*
 * This file is part of the "cs_file_meta_fill" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 Pascale Beier <beier@clickstorm.de>, clickstorm GmbH
 *
 */

use Clickstorm\CsFileMetaFill\Domain\Repository\OriginalFileNameRepository;
use Clickstorm\CsFileMetaFill\Utility\ConfigurationUtility;
use Clickstorm\CsFileMetaFill\Utility\FluentImageSourceUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Resource\DuplicationBehavior;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class File
 */
final class File implements \TYPO3\CMS\Core\Utility\File\ExtendedFileUtilityProcessDataHookInterface
{
    /**
     * Called every time a file is processed
     *
     * Does nothing if a File already has alternative data.
     *
     * @param \TYPO3\CMS\Core\Resource\Service\FileProcessingService $fileProcessingService
     * @param \TYPO3\CMS\Core\Resource\Driver\DriverInterface $driver
     * @param \TYPO3\CMS\Core\Resource\ProcessedFile $processedFile
     */
    public function postFileProcess($fileProcessingService, $driver, $processedFile)
    {
        // Exit early if neither alternative nor title are NULL.
        if (! empty($processedFile->getProperty('alternative')) && ! empty($processedFile->getProperty('title'))) {
            return;
        }

        $file   = $processedFile->getOriginalFile();
        $fluent = OriginalFileNameRepository::findByFinalFileName($file->getProperty('name')) ??
                  FluentImageSourceUtility::getFluentSentence($file->getProperty('name'));

        $metaData = [
            'alternative' => $file->getProperty('alternative') ?? $fluent,
        ];

        // Only Fill title if desired
        if (ConfigurationUtility::fillTitle()) {
            $metaData['title'] = $file->getProperty('title') ?? $fluent;
        }

        $metaData = array_merge($file->getMetaData()->get(), $metaData);

        $file->getMetaData()->add($metaData);
        $file->getMetaData()->save();
    }

    /**
     * Hook into FAL Transactions to store original file names.
     *
     * @see https://github.com/clickstorm/cs_file_meta_fill/issues/1
     *
     * @param string $action The action
     * @param array $cmdArr The parameter sent to the action handler
     * @param array $result The results of all calls to the action handler
     * @param \TYPO3\CMS\Core\Utility\File\ExtendedFileUtility $pObj The parent object
     */
    public function processData_postProcessAction(
        $action,
        array $cmdArr,
        array $result,
        \TYPO3\CMS\Core\Utility\File\ExtendedFileUtility $pObj
    ) {
        // Hook into any File Upload Stuff where a new File will be uploaded
        // Exit for rewrite, rename and copy actions.
        if ($action !== 'upload' || empty($_FILES) || $pObj->getExistingFilesConflictMode() !== DuplicationBehavior::CANCEL) {
            return;
        }

        $i = 0;
        foreach ($_FILES as $file) {
            try {
                GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('cs_file_meta_fill')
                              ->insert('cs_file_meta_fill', [
                                  'original_filename' => FluentImageSourceUtility::getFluentSentence($file['name']),
                                  'final_filename'    => $result[$i][0]->getProperty('name'),
                              ]);
                $i++;
            } catch (\Exception $e) {
                // This is quite tricky to handle, since file uploads were not necessarily successful
                // or a file with the same constraints might already exist
                // for now, we will just continue
                continue;
            }
        }
    }
}

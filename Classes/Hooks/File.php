<?php declare(strict_types=1);
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

use Clickstorm\CsFileMetaFill\Utility\FluentImageSourceUtility;

/**
 * Class File
 * @package Clickstorm\CsFileMetaFill\Hooks
 */
final class File
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

        $file = $processedFile->getOriginalFile();
        $fluent = FluentImageSourceUtility::getFluentSentence($file->getName());

        $metaData = [
            'alternative' => $file->getProperty('alternative') ?? $fluent,
            'title' => $file->getProperty('title') ?? $fluent,
        ];

        $metaData = array_merge($file->_getMetaData(), $metaData);

        $file->_updateMetaDataProperties($metaData);

        $metaDataRepository = \TYPO3\CMS\Core\Resource\Index\MetaDataRepository::getInstance();
        $metaDataRepository->update($file->getUid(), $metaData);
    }
}

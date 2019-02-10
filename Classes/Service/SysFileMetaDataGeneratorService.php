<?php declare(strict_types=1);
namespace Clickstorm\CsFileMetaFill\Service;

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
use Clickstorm\CsFileMetaFill\Utility\FluentImageSourceUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class SysFileMetaDataGeneratorService
 * @package Clickstorm\CsFileMetaFill\Service
 */
final class SysFileMetaDataGeneratorService
{
    /**
     * Look for all sys_file records without alternative attribute
     * and fill the attribute column with our fluent sentence
     *
     * Meant for usage in a Task / CommandController
     *
     * @return int
     */
    public function execute(): int
    {
        $connection = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Database\ConnectionPool::class)->getConnectionForTable('sys_file');
        $q = $connection->createQueryBuilder();

        $files = $q->select('name', 'm.alternative', 'm.title', 'm.uid')
            ->from('sys_file', 'f')
            ->leftJoin('f', 'sys_file_metadata', 'm', 'm.file = f.uid')
            ->orWhere(
                $q->expr()->isNull('m.alternative'),
                $q->expr()->isNull('m.title')
            )
            ->execute()
            ->fetchAll();

        foreach ($files as $file) {
            $fluent = OriginalFileNameRepository::findByFinalFileName($file['name']) ??
                      FluentImageSourceUtility::getFluentSentence($file['name']);

            $connection->update(
                'sys_file_metadata',
                [
                    'alternative' => $file['alternative'] ?? $fluent,
                    'title' => $file['title'] ?? $fluent,
                ],
                ['uid' => $file['uid']]
            );
        }

        return count($files);
    }
}

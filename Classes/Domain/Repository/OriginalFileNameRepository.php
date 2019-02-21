<?php declare(strict_types=1);
namespace Clickstorm\CsFileMetaFill\Domain\Repository;

/*
 * This file is part of the "cs_file_meta_fill" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 Pascale Beier <beier@clickstorm.de>, clickstorm GmbH
 *
 */

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class OriginalFileNameRepository
 */
final class OriginalFileNameRepository
{
    /**
     * @param string $finalFileName
     *
     * @return string|null
     */
    public static function findByFinalFileName(string $finalFileName): ?string
    {
        $q = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('cs_file_meta_fill');

        $q->select('original_filename')
            ->from('cs_file_meta_fill')
            ->where(
                $q->expr()->eq('final_filename', $q->createNamedParameter($finalFileName))
            );

        return $q->execute()->fetchColumn() ?? null;
    }
}

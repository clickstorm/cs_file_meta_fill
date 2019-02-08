<?php declare(strict_types=1);
namespace Clickstorm\CsFileMetaFill\Command;

/*
 * This file is part of the "cs_file_meta_fill" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 Pascale Beier <beier@clickstorm.de>, clickstorm GmbH
 *
 */

use Clickstorm\CsFileMetaFill\Service\SysFileMetaDataGeneratorService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\CommandController;

/**
 * Class UpdateMetadataCommandController
 * @package Clickstorm\CsFileMetaFill\Command
 *
 * @cli
 */
final class UpdateMetadataCommandController extends CommandController
{
    /**
     * @see SysFileMetaDataGeneratorService
     *
     * @return int
     *
     * @throws \Doctrine\DBAL\ConnectionException
     */
    public function runCommand()
    {
        return GeneralUtility::makeInstance(SysFileMetaDataGeneratorService::class)->execute();
    }
}

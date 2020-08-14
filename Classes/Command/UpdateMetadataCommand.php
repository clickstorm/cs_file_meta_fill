<?php declare(strict_types = 1);
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
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class UpdateMetadataCommandController
 *
 * @cli
 */
final class UpdateMetadataCommand extends Command
{
    /**
     * Configure the command by defining the name, options and arguments
     */
    protected function configure(): void
    {
        $this->setDescription('Fills empty file Metadata with information of the file name.');
    }


    /**
     * @see SysFileMetaDataGeneratorService
     *
     * @return int
     *
     * @throws \Doctrine\DBAL\ConnectionException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        return GeneralUtility::makeInstance(SysFileMetaDataGeneratorService::class)->execute();
    }
}

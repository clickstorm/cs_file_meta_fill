<?php declare(strict_types = 1);
namespace Clickstorm\CsFileMetaFill\Utility;

/*
 * This file is part of the "cs_file_meta_fill" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 Pascale Beier <beier@clickstorm.de>, clickstorm GmbH
 *
 */

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class ConfigurationUtility
 */
final class ConfigurationUtility
{
    /** @var array */
    private static $extConf;

    /**
     * Get ExtensionConfiguration for v8 and v9
     *
     * @return array
     */
    public static function getExtensionConfiguration(): array
    {
        if (empty(static::$extConf)) {
            $extensionConfiguration = 'TYPO3\CMS\Core\Configuration\ExtensionConfiguration';
            if (class_exists($extensionConfiguration)) {
                return static::$extConf = GeneralUtility::makeInstance($extensionConfiguration)
                    ->get('cs_file_meta_fill');
            }

            return static::$extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['cs_file_meta_fill']);
        }

        return static::$extConf;
    }

    /**
     * Determine if the title field should be filled.
     *
     * @return bool
     */
    public static function fillTitle(): bool
    {
        return in_array(static::getExtensionConfiguration()['enableTitleFill'], ['1', true], true);
    }
}

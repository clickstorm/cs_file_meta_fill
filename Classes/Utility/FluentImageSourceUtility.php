<?php declare(strict_types=1);
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

use Doctrine\Common\Inflector\Inflector;

/**
 * Class FluentImageSourceUtility
 */
final class FluentImageSourceUtility
{
    /**
     * Build a fluent sentence from a string
     *
     * @param string $source
     * @return string
     */
    public static function getFluentSentence(string $source): string
    {
        // Normalize all special chars to _ and replace it with a space
        // Remove more than one space following another space
        $sentence = preg_replace(
            ['/_/', '/-/', '/\s{2,}/'],
            ' ',
            Inflector::tableize(pathinfo($source)['filename'] ?? $source)
        );

        // Uppercase all words
        return Inflector::ucwords($sentence);
    }
}

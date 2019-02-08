<?php declare(strict_types=1);

namespace Clickstorm\CsFileMetaFill\Tests\Unit;

use Nimut\TestingFramework\TestCase\UnitTestCase;
use Clickstorm\CsFileMetaFill\Utility\FluentImageSourceUtility;

final class FluentImageSourceUtilityTest extends UnitTestCase
{
    /**
     * @dataProvider sentences
     *
     * @param $expected
     * @param $equals
     */
    public function testGetFluentSentence($expected, $equals)
    {
        $this->assertEquals($expected, FluentImageSourceUtility::getFluentSentence($equals));
    }

    /**
     * @return array
     */
    public function sentences()
    {
        return [
            [
                'Gewandhausorchester Bratsche 20140703 26 A7428',
                'Gewandhausorchester_Bratsche_20140703_26A7428.jpg',
            ],
            [
                '12 Gas Analyser Oxybaby',
                '12_Gas_Analyser_Oxybaby.JPG',
            ],
            [
                'Witt Product Oxybaby',
                'witt_product_oxybaby.jpg',
            ],
            [
                'Banner Desktop',
                'banner-desktop.png',
            ],
            [
                'Banner Desktop',
                'banner-desktop',
            ]
        ];
    }
}

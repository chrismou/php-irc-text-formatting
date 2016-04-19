<?php
/**
 * PHP library for adding color and styling to IRC text output (https://github.com/chrismou/php-irc-text-formatting)
 *
 * @link https://github.com/chrismou/php-irc-text-formatting for the canonical source repository
 * @copyright Copyright (c) 2015 Chris Chrisostomou (https://mou.me)
 * @license http://phergie.org/license New BSD License
 * @package Chrismou\Irc\TextFormatting
 */

namespace Chrismou\Irc\TextFormatting\Tests;

use Chrismou\Irc\TextFormatting\Format;

/**
 * Tests for the Plugin class.
 *
 * @category Chrismou
 * @package Chrismou\Irc\TextFormatting
 */
class FormatTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test color responses are what we're expecting
     */
    public function testColor()
    {
        $string = "This is a test string";

        $format = new Format;

        $validConvertedString = $format->color($string, "red");
        $invalidConvertedString = $format->color($string, "fakeColor");

        // Check real and fake colours still return a string
        $this->assertInternalType('string', $validConvertedString);
        $this->assertInternalType('string', $invalidConvertedString);

        $this->assertSame($validConvertedString, "\x0304" . $string . "\x03");
        $this->assertSame($invalidConvertedString, $string);
    }

    /**
     * Test style responses are what we're expecting
     */
    public function testStyle()
    {
        $string = "This is a test string";

        $format = new Format;

        $boldString = $format->style($string, "bold");
        $underlineString = $format->style($string, "underline");
        $reverseString = $format->style($string, "reverse");
        $invalidStyle = $format->style($string, "stylissimo");


        // Check the tested styles are still returning strings
        $this->assertInternalType('string', $boldString);
        $this->assertInternalType('string', $underlineString);
        $this->assertInternalType('string', $reverseString);
        $this->assertInternalType('string', $invalidStyle);


        $this->assertSame($boldString, "\x02" . $string . "\x02");
        $this->assertSame($underlineString, "\x1F" . $string . "\x1F");
        $this->assertSame($reverseString, "\x16" . $string . "\x16");
        $this->assertSame($invalidStyle, $string);
    }

    /**
     * Test rainbow responses are what we're expecting
     */
    public function testRainbow()
    {
        // Test with and without spaces, and over 7 characters
        $string1 = "abcdefg";
        $string2 = "a b c d efg";
        $string3 = "abcdefgh";

        $format = new Format;

        $convertedString1 = $format->rainbow($string1);
        $convertedString2 = $format->rainbow($string2);
        $convertedString3 = $format->rainbow($string3);

        // Check real and fake colours still return a string
        $this->assertInternalType('string', $convertedString1);
        $this->assertInternalType('string', $convertedString2);
        $this->assertInternalType('string', $convertedString3);

        $this->assertSame("\x0304a\x03\x0308b\x03\x0313c\x03\x0303d\x03\x0306e\x03\x0307f\x03\x0302g\x03",
            $convertedString1);
        $this->assertSame("\x0304a\x03 \x0308b\x03 \x0313c\x03 \x0303d\x03 \x0306e\x03\x0307f\x03\x0302g\x03",
            $convertedString2);
        $this->assertSame("\x0304a\x03\x0308b\x03\x0313c\x03\x0303d\x03\x0306e\x03\x0307f\x03\x0302g\x03\x0304h\x03",
            $convertedString3);
    }

    /**
     * @dataProvider mircColors
     */
    public function testMircColors($color, $expected)
    {
        $format = new Format();
        $result = $format->color('', $color);
        $expected = "\x03$expected\x03";
        $this->assertEquals($expected, $result);
    }

    /**
     * @link http://www.mirc.com/colors.html
     * @return array
     */
    public function mircColors()
    {
        return array(
            array('white', "00"),
            array('black', "01"),
            array('blue', "02"),
            array('green', "03"),
            array('light red', "04"),
            array('brown', "05"),
            array('purple', "06"),
            array('orange', "07"),
            array('yellow', "08"),
            array('light green', "09"),
            array('cyan', "10"),
            array('light cyan', "11"),
            array('light blue', "12"),
            array('pink', "13"),
            array('grey', "14"),
            array('light grey', "15"),
        );
    }
}

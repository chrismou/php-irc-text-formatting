<?php
/**
 * Phergie plugin for providing a simple way to add color/styling to your plugin's text output (https://github.com/chrismou/phergie-irc-plugin-react-format)
 *
 * @link https://github.com/chrismou/phergie-irc-plugin-react-format for the canonical source repository
 * @copyright Copyright (c) 2014 Chris Chrisostomou (http://mou.me)
 * @license http://phergie.org/license New BSD License
 * @package Chrismou\Phergie\Plugin\Format
 */

namespace Chrismou\Phergie\Tests\Plugin\Format;

use Phake;
use Phergie\Irc\Bot\React\EventQueueInterface as Queue;
use Phergie\Irc\Event\EventInterface as Event;
use Chrismou\Phergie\Plugin\Format\Plugin;

/**
 * Tests for the Plugin class.
 *
 * @category Chrismou
 * @package Chrismou\Phergie\Plugin\Format
 */
class PluginTest extends \PHPUnit_Framework_TestCase
{


    /**
     * Tests that getSubscribedEvents() returns an array.
     */
    public function testGetSubscribedEvents()
    {
        $plugin = new Plugin;
        $this->assertInternalType('array', $plugin->getSubscribedEvents());
        $this->assertEmpty($plugin->getSubscribedEvents());
    }

    /**
     * Test color responses are what we're expecting
     */
    public function testColor()
    {
        $string = "This is a test string";

        $plugin = new Plugin;

        $validConvertedString = $plugin->color($string, "red");
        $invalidConvertedString = $plugin->color($string, "fakeColor");

        // Check real and fake colours still return a string
        $this->assertInternalType('string', $validConvertedString);
        $this->assertInternalType('string', $invalidConvertedString);

        $this->assertSame($validConvertedString, "\x0304".$string."\x03");
        $this->assertSame($invalidConvertedString, $string);
    }

    /**
     * Test style responses are what we're expecting
     */
    public function testStyle()
    {
        $string = "This is a test string";

        $plugin = new Plugin;

        $boldString = $plugin->style($string, "bold");
        $underlineString = $plugin->style($string, "underline");
        $reverseString = $plugin->style($string, "reverse");
        $invalidStyle = $plugin->style($string, "stylissimo");


        // Check the tested styles are still returning strings
        $this->assertInternalType('string', $boldString);
        $this->assertInternalType('string', $underlineString);
        $this->assertInternalType('string', $reverseString);
        $this->assertInternalType('string', $invalidStyle);


        $this->assertSame($boldString, "\x02".$string."\x02");
        $this->assertSame($underlineString, "\x1F".$string."\x1F");
        $this->assertSame($reverseString, "\x16".$string."\x16");
        $this->assertSame($invalidStyle, $string);
    }

    /**
     * Test color responses are what we're expecting
     */
    public function testRainbow()
    {
        // The rainbow method skips blank characters, so test with and without
        $string1 = "abcdefg";
        $string2 = "a b c d efg";

        $plugin = new Plugin;

        $convertedString1 = $plugin->rainbow($string1);
        $convertedString2 = $plugin->rainbow($string2);

        // Check real and fake colours still return a string
        $this->assertInternalType('string', $convertedString1);
        $this->assertInternalType('string', $convertedString2);

        $this->assertSame($convertedString1, "\x0304a\x03\x0308b\x03\x0313c\x03\x0303d\x03\x0306e\x03\x0307f\x03\x0302g\x03");
        $this->assertSame($convertedString2, "\x0304a\x03 \x0308b\x03 \x0313c\x03 \x0303d\x03 \x0306e\x03\x0307f\x03\x0302g\x03");
    }
}

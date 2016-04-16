<?php
/**
 * PHP library for adding color and styling to IRC text output (https://github.com/chrismou/php-irc-text-formatting)
 *
 * @link https://github.com/chrismou/php-irc-text-formatting for the canonical source repository
 * @copyright Copyright (c) 2015 Chris Chrisostomou (https://mou.me)
 * @license http://phergie.org/license New BSD License
 * @package Chrismou\Irc\TextFormatting
 */

namespace Chrismou\Irc\TextFormatting;

/**
 * Plugin class.
 *
 * @category Chrismou
 * @package Chrismou\Irc\TextFormatting
 */
class Format
{
    /**
     * @var string
     */
    protected $colorTag = "\x03";

    /**
     * @var array
     * @link http://www.mirc.com/colors.html
     * @link https://github.com/myano/jenni/wiki/IRC-String-Formatting
     */
    protected $colorCodes = array(
        'white' => '00',
        'black' => '01',
        'blue' => '02',
        'navy' => '02',
        'green' => '03',
        'red' => '04',
        'lightRed' => '04',
        'light red' => '04',
        'brown' => '05',
        'maroon' => '05',
        'purple' => '06',
        'orange' => '07',
        'olive' => '07',
        'yellow' => '08',
        'lightGreen' => '09',
        'light green' => '09',
        'lime' => '09',
        'teal' => '10',
        'green cyan' => '10',
        'blue cyan' => '10',
        'cyan' => '10',
        'aqua' => '11',
        'light cyan' => '11',
        'lightCyan' => '11',
        'lightBlue' => '12',
        'light blue' => '12',
        'royal' => '12',
        'pink' => '13',
        'light purple' => '13',
        'lightPurple' => '13',
        'fuchsia' => '13',
        'grey' => '14',
        'lightGrey' => '15',
        'light grey' => '15',
        'silver' => '15',
    );

    /**
     * @var array
     */
    protected $styleTag = array(
        'bold' => "\x02",
        'underline' => "\x1F",
        //'italic'        => "\x09",    // Poor support
        //'strikethrough' => "\x13",    // Poor support
        'reverse' => "\x16",
    );

    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Generate a string with the foreground/background color specified
     *
     * @param string $text
     * @param string $foregroundColor
     * @param string $backgroundColor
     * @return string
     */
    public function color($text, $foregroundColor, $backgroundColor = null)
    {
        // If the foreground doesn't exist or is empty, quit now and return the original string
        return (!$foregroundColor || !isset($this->colorCodes[$foregroundColor])) ? $text : sprintf(
            "%s%s%s%s%s",
            $this->colorTag,
            $this->colorCodes[$foregroundColor],
            ($backgroundColor !== null && isset($this->colorCodes[$backgroundColor]))
                ? sprintf(",%s", $this->colorCodes[$backgroundColor])
                : "",
            $text,
            $this->colorTag
        );
    }

    /**
     * Generate a string with the text style specified
     *
     * @param string $text
     * @param string $style
     * @return string
     */
    public function style($text, $style)
    {
        return sprintf(
            "%s%s%s",
            (isset($this->styleTag[$style])) ? $this->styleTag[$style] : "",
            $text,
            (isset($this->styleTag[$style])) ? $this->styleTag[$style] : ""
        );
    }

    /**
     * Generate a rainbow coloured string
     *
     * @param $text
     * @return string
     */
    public function rainbow($text)
    {
        $rainbow = array('red', 'yellow', 'pink', 'green', 'purple', 'orange', 'blue');
        $output = "";
        $rainbowKey = 0;
        $charCount = strlen($text);

        for ($a = 0; $a < $charCount; $a++) {

            if ($rainbowKey > count($rainbow) - 1) {
                $rainbowKey = 0;
            }

            $char = substr($text, $a, 1);

            // Ignore spaces
            if ($char == " ") {
                $output .= $char;
                continue;
            }

            // Style the current character
            $output .= $this->color($char, $rainbow[$rainbowKey]);

            $rainbowKey++;
        }

        return $output;
    }
}

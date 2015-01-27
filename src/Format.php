<?php
/**
 * PHP library for adding color and styling to IRC text output (https://github.com/chrismou/php-irc-text-formatting)
 *
 * @link https://github.com/chrismou/php-irc-text-formatting for the canonical source repository
 * @copyright Copyright (c) 2014 Chris Chrisostomou (http://mou.me)
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
     */
    protected $colorCodes = array(
        'white'         => '00',
        'black'         => '01',
        'blue'          => '02',
        'green'         => '03',
        'red'           => '04',
        'brown'         => '05',
        'purple'        => '06',
        'orange'        => '07',
        'yellow'        => '08',
        'lightGreen'    => '10',
        'teal'          => '10',
        'cyan'          => '11',
        'lightBlue'     => '12',
        'pink'          => '13',
        'grey'          => '14',
        'lightGrey'     => '15'
    );

    /**
     * @var array
     */
    protected $styleTag = array(
        'bold'          => "\x02",
        'underline'     => "\x1F",
        //'italic'        => "\x09",    // Poor support
        //'strikethrough' => "\x13",    // Poor support
        'reverse'       => "\x16",
    );

    /**
     * @param array $config
     */
    public function __construct()
    {
    }

    /**
     * Generate a string with the foreground/background color specified
     *
     * @param string $text
     * @param string $foregroundColor
     * @param string|false $backgroundColor
     * @return string
     */
    public function color($text, $foregroundColor, $backgroundColor=false)
    {
        // If the foreground doesn't exist or is empty, quit now and return the original string
        return (!$foregroundColor || !isset($this->colorCodes[$foregroundColor])) ? $text : sprintf("%s%s%s%s%s",
            $this->colorTag,
            $this->colorCodes[$foregroundColor],
            ($backgroundColor && isset($this->colorCodes[$backgroundColor])) ? sprintf(",%s", $this->colorCodes[$backgroundColor]) : "",
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
        return sprintf("%s%s%s",
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

        for($a=0;$a<strlen($text);$a++) {

            if ($rainbowKey > count($rainbow)-1) $rainbowKey = 0;

            $char = substr($text, $a, 1);

            // Ignore spaces
            if ($char==" ") {
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
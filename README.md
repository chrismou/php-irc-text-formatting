# IRC color/style library for PHP

PHP library for adding color and styling to IRC text output

[![Build Status](https://scrutinizer-ci.com/g/chrismou/php-irc-text-formatting/badges/build.png?b=master)](https://scrutinizer-ci.com/g/chrismou/php-irc-text-formatting/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/chrismou/php-irc-text-formatting/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/chrismou/php-irc-text-formatting/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/chrismou/php-irc-text-formatting/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/chrismou/php-irc-text-formatting/?branch=master)

## About

This plugin is designed to provide IRC script writers a simple way to add colors/styles to their output. It should be compatible with most major PHP IRC bots, such as 
[Phergie](https://github.com/phergie/phergie-irc-bot-react).

## Install

The recommended method of installation is [through composer](http://getcomposer.org).

```
composer require chrismou/php-irc-text-formatting
```

## Configuration

To begin adding formatting to ouput text within your own applications, you'll need to include it in your project.  The simplest way of doing this is as follows:

```php
protected $format;

function __construct(array $config=array())
{
    $this->format = new \Chrismou\Irc\TextFormatting\Format;
    ...
}
```

Or, if you're only using it once, you can just include it directly in your method.

```php
public function foo
{
    $format = new \Chrismou\Irc\TextFormatting\Format;
    ...
}
```

## Usage

The 3 methods available are **color**, **style** and **rainbow**.

#### Color
This takes 3 parameters.  First is the text, second is the text color, third is the background colour (optional).

```php
$format = new \Chrismou\Irc\TextFormatting\Format;
$format->color("This text will be red", "red");
$format->color("This text will be blue on a green background", "blue", "green");
```

**Available color codes:**
* white
* black
* blue
* green
* red
* brown
* purple
* orange
* yellow
* lightGreen
* teal
* cyan
* lightBlue
* pink
* grey
* lightGrey


#### Style
This takes 2 parameters.  First is the text, second is the style to use.

```php
$format = new \Chrismou\Irc\TextFormatting\Format;
$format->style("This text will be underlined", "underline");
```

**Available style codes:**
* bold
* underline
* reverse (switches foreground and background color)

I've purposely excluded strikethrough and italic codes as support for them among IRC clients is fairly poor.

#### Rainbow
This takes a single parameter - the text - and gives the string a rainbow colouring.
```php
$format = new \Chrismou\Irc\TextFormatting\Format;
$format->rainbow("This text will be FABULOUS"); // produces rainbow coloured text
```

## Tests

To run the unit test suite:

```
curl -s https://getcomposer.org/installer | php
php composer.phar install
./vendor/bin/phpunit
```

Or to test on all supported versions, ensure docker is installed and running, then run:

```
curl -s https://getcomposer.org/installer | php
php composer.phar install
./vendor/bin/dunit
```

## License

Released under the BSD License. See `LICENSE`.

# Text formatting plugin for [Phergie](http://github.com/phergie/phergie-irc-bot-react/)

[Phergie](http://github.com/phergie/phergie-irc-bot-react/) developer plugin for providing a simple way to add color/styling to your own plugin's text output.

[![Build Status](https://travis-ci.org/chrismou/phergie-irc-plugin-react-formatting.svg)](https://travis-ci.org/chrismou/phergie-irc-plugin-react-formatting)
[![Code Climate](https://codeclimate.com/github/chrismou/phergie-irc-plugin-react-formatting/badges/gpa.svg)](https://codeclimate.com/github/chrismou/phergie-irc-plugin-react-formatting)
[![Test Coverage](https://codeclimate.com/github/chrismou/phergie-irc-plugin-react-formatting/badges/coverage.svg)](https://codeclimate.com/github/chrismou/phergie-irc-plugin-react-formatting)

## About

This plugin is designed to provide Phergie plugin developers a simple way to add colors/styles to their output.  It isn't designed to react to any IRC events,
and so won't do anything if you add it to your bot config - it's designed predominantly for use in other plugins.

## Install

The recommended method of installation is [through composer](http://getcomposer.org).

```JSON
{
    "require": {
        "chrismou/phergie-irc-plugin-react-formatting": "dev-master"
    }
}
```

See Phergie documentation for more information on
[installing and enabling plugins](https://github.com/phergie/phergie-irc-bot-react/wiki/Usage#plugins).

## Configuration

To begin adding formatting to ouput text within your own plugins, you'll need to include it somewhere withing your plugin class.  The simplest way of doing 
this is as follows:

```php
protected $format;

function __construct(array $config=array())
{
    $this->format = new \Chrismou\Phergie\Plugin\Formatting\Plugin;
    ...
}
```

Or, if you're only using it once, you can just include it directly in your method.
```php
public function foo
{
    $format = new \Chrismou\Phergie\Plugin\Formatting\Plugin;
    ...
}
```

## Usage

The 3 methods available are **color**, **style** and **rainbow**.

#### Color
This takes 3 parameters.  First is the text, second is the text color, third is the background colour (optional).

```php
$format = new \Chrismou\Phergie\Plugin\Formatting\Plugin;
$format->color("This text will be red", "red"); // produces red text on the default background colour
$format->color("This text will be blue on green", "red", "green"); // produces red text on a green background
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
$format = new \Chrismou\Phergie\Plugin\Formatting\Plugin;
$format->style("This text will be underlined", "underline"); // produces underlined text
```

**Available style codes:**
* bold
* underline
* reverse (switches foreground and background color)

I've purposely excluded the lesser used strikethrough and italic codes as support for them among IRC clients is fairly poor.

#### Rainbow
This takes a single parameter - the text - and gives the string a rainbow colouring.
```php
$format = new \Chrismou\Phergie\Plugin\Formatting\Plugin;
$format->rainbow("This text will be FABULOUS"); // produces rainbow coloured text
```

## Tests

To run the unit test suite:

```
curl -s https://getcomposer.org/installer | php
php composer.phar install
./vendor/bin/phpunit
```

## License

Released under the BSD License. See `LICENSE`.

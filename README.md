# PHP string processor library

## Description
This library is a collection of string processors.

## Installation

This package is [composer-enabled](https://packagist.org/packages/kolyunya/string-processor). Just require it in your composer.json.
~~~
"require": {
    "kolyunya/string-processor": "*"
}
~~~

## Usage
Each processor implement [ProcessorInterface](https://github.com/Kolyunya/string-processor/blob/master/sources/ProcessorInterface.php) which contains just one method:
~~~php
/**
 * Processes a string and returns a processed version of the original string.
 * @param string $string A string to process.
 * @return string A processed version of the original string.
 */
public function process($string);
~~~

Construct a processor and just run `process($string)` on it:
~~~php
$processor = new SomeArbitraryProcessor();
// Configure processor if needed
$processedString = $processor->process($string);
~~~

## Available processors
Currently the following processors are implemented
* [KebabFormatter](https://github.com/Kolyunya/string-processor/blob/master/sources/KebabFormatter.php) - A processor which converts a string to `the-kebab-case`.
* [Multiprocessor](https://github.com/Kolyunya/string-processor/blob/master/sources/Multiprocessor.php) - A processor which combines multiple processors.

# PHP string procession library

## Description
This library provides a collection of string processors.

## Installation

This library is [composer-enabled](https://packagist.org/packages/kolyunya/string-processor). The recommended way of using it in your project is to require it in your `composer.json`.
~~~
"require": {
    "kolyunya/string-processor": "*"
}
~~~

## Usage

### Basic usage
Each processor implement [ProcessorInterface](https://github.com/Kolyunya/string-processor/blob/master/sources/ProcessorInterface.php) which contains just one method:
~~~php
/**
 * Processes a string and returns a processed version of the original string.
 * @param string $string A string to process.
 * @return string A processed version of the original string.
 */
public function process($string);
~~~

Construct a processor and run `process($string)` on it:
~~~php
$processor = new Processor();
echo $processor->process($string);
~~~

### Shorthand usage
You can also use a processor without even instantiating it. Each processor has a static `run($string)` method. Note that the processor invoked in such way will be default-instantiated which may be not suitable for some processors.
~~~php
echo KebabCaseFormatter::run('snake_case'); // Output: "snake-case"
~~~

### Combining multiple processors
Suppose you want to convert a stirng to an upper-kebab case. To achieve this you can combine two processors like this:
~~~php
$processor = new Multiprocessor([
    new KebabCaseFormatter(),
    new UpperCaseFormatter(),
]);
echo $processor->process('snake_case'); // Output: "SNAKE-CASE"
~~~
Note the the processors order matters. If you pass a kebab formatter as a second processor it will convert the string back to the lower case (normal kebab case).

## Available processors
Currently the following processors are implemented
* [Case switchers](https://github.com/Kolyunya/string-processor/blob/master/sources/Format/CaseSwitcher.php)
    * [CamelCaseFormatter](https://github.com/Kolyunya/string-processor/blob/master/sources/Format/CamelCaseFormatter.php) - formats a string to the `CamelCase`.
    * [KebabCaseFormatter](https://github.com/Kolyunya/string-processor/blob/master/sources/Format/KebabCaseFormatter.php) - formats a string to the `kebab-case`.
    * [SnakeCaseFormatter](https://github.com/Kolyunya/string-processor/blob/master/sources/Format/SnakeCaseFormatter.php) - formats a string to the `snake_case`.
    * [UpperCaseFormatter](https://github.com/Kolyunya/string-processor/blob/master/sources/Format/UpperCaseFormatter.php) - formats a string to the `UPPER CASE`.
    * [LowerCaseFormatter](https://github.com/Kolyunya/string-processor/blob/master/sources/Format/LowerCaseFormatter.php) - formats a string to the `lower case`.
* [Translators](https://github.com/Kolyunya/string-processor/blob/master/sources/Translit/Translator.php) - transliterates strings from one language to another.
    * [RuEnTranslator](https://github.com/Kolyunya/string-processor/blob/master/sources/Translit/RuEnTranslator.php) - transliterates strings from Russian to English and the other way around.
* [Multiprocessor](https://github.com/Kolyunya/string-processor/blob/master/sources/Multiprocessor.php) - combines multiple processors.

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

## Single processor usage

### Basic usage
Each processor implements the [ProcessorInterface](https://github.com/Kolyunya/string-processor/blob/master/sources/ProcessorInterface.php) which contains just one method:
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

## Processors combination

### Using `Multiprocessor`
There is a special processor ([`Multiprocessor`](https://github.com/Kolyunya/string-processor/blob/master/sources/Multiprocessor.php)) which allows you to combine multiple processors in one. Suppose you want to convert a string to an `UPPER-KEBAB` case. You can combine two processors using `Multiprocessor` to solve this problem.
~~~php
$processor = new Multiprocessor([
    new KebabCaseFormatter(),
    new UpperCaseFormatter(),
]);
echo $processor->process('snake_case'); // Output: "SNAKE-CASE"
echo $processor->process('CamelCase'); // Output: "CAMEL-CASE"
~~~
The `UpperCaseFormatter` will be applied after the `KebabCaseFormatter`. Note that either the processors order does not matter in the first example, it actually matters in the second one.

Another common problem example is to generate URL slugs. A string should be converted to the `kebab-case` and transliterated. Combine the `KebabCaseFormatter` and the `Translator` using `Multiprocessor`.
~~~php
$processor = new Multiprocessor([
    new KebabCaseFormatter(),
    new RuEnTranslator(),
]);
echo $processor->process('Лорем ипсум долор сит амет'); // Output: "lorem-ipsum-dolor-sit-amet"
~~~

## Available processors
Currently the following processors are implemented
* [Case switchers](https://github.com/Kolyunya/string-processor/blob/master/sources/Format/CaseSwitcher.php) - format strings to arbitrary formats.
    * [CamelCaseFormatter](https://github.com/Kolyunya/string-processor/blob/master/sources/Format/CamelCaseFormatter.php) - formats a string to the `CamelCase`.
    * [KebabCaseFormatter](https://github.com/Kolyunya/string-processor/blob/master/sources/Format/KebabCaseFormatter.php) - formats a string to the `kebab-case`.
    * [SnakeCaseFormatter](https://github.com/Kolyunya/string-processor/blob/master/sources/Format/SnakeCaseFormatter.php) - formats a string to the `snake_case`.
    * [UpperCaseFormatter](https://github.com/Kolyunya/string-processor/blob/master/sources/Format/UpperCaseFormatter.php) - formats a string to the `UPPER CASE`.
    * [LowerCaseFormatter](https://github.com/Kolyunya/string-processor/blob/master/sources/Format/LowerCaseFormatter.php) - formats a string to the `lower case`.
* [Translators](https://github.com/Kolyunya/string-processor/blob/master/sources/Translit/Translator.php) - transliterate strings from one language to another.
    * [RuEnTranslator](https://github.com/Kolyunya/string-processor/blob/master/sources/Translit/RuEnTranslator.php) - transliterates strings from Russian to English and the other way around.
* Purifiers - purify strings.
    * [PunctuationStripper](https://github.com/Kolyunya/string-processor/blob/master/sources/Purify/PunctuationStripper.php) - Strips punctuation characters.
* [Multiprocessor](https://github.com/Kolyunya/string-processor/blob/master/sources/Multiprocessor.php) - combines multiple processors.

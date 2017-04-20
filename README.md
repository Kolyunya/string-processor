# PHP string processing library

## Status
[![Build Status](https://travis-ci.org/Kolyunya/string-processor.svg?branch=master)](https://travis-ci.org/Kolyunya/string-processor)
[![Dependency Status](https://www.versioneye.com/user/projects/58f8b0a26ac1710042505b00/badge.svg?style=flat-square)](https://www.versioneye.com/user/projects/58f8b0a26ac1710042505b00)
[![Latest Stable Version](https://poser.pugx.org/kolyunya/string-processor/v/stable)](https://packagist.org/packages/kolyunya/string-processor)
[![License](https://poser.pugx.org/kolyunya/string-processor/license)](https://packagist.org/packages/kolyunya/string-processor)
[![Total Downloads](https://poser.pugx.org/kolyunya/string-processor/downloads)](https://packagist.org/packages/kolyunya/string-processor)

## Description
This library provides a collection of string processors.

## Installation
This library is [composer-enabled](https://packagist.org/packages/kolyunya/string-processor). The recommended way of using it in your project is to require it via `composer`.
~~~
composer require kolyunya/string-processor
~~~

## Single processor usage

### Basic usage
Each processor implements the [ProcessorInterface](https://github.com/Kolyunya/string-processor/blob/master/sources/ProcessorInterface.php) which contains the `process` method:
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
You can also use a processor without even instantiating it. Each processor has a static `run` method.
~~~php
/**
 * Processes a string and returns a processed version of the original string.
 * @param string $string A string to process.
 * @param object|array $parameters Parameters passed to the processor's constructor.
 * @return string A processed version of the original string.
 */
public static function run($string, $parameters = array());
~~~
You can pass parameters to the processor's constructor in the `$parameters` array. You can also pass a single parameter without wrapping it into an array.
~~~php
echo KebabCaseFormatter::run('snake_case'); // Output: "snake-case"
echo Translator::run(
    'Лорем ипсум долор сит амет',
    new RuEnDictionary()
); // Output: "Lorem ipsum dolor sit amet"
~~~

## Processors combination

### `Multiprocessor` usage
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

Another common problem example is to generate URL slugs. A string should be purified from punctuation characters, converted to the `kebab-case` and transliterated. Combine the `PunctuationStripper`, the `KebabCaseFormatter` and the `Translator` using `Multiprocessor`.
~~~php
$processor = new Multiprocessor([
    new RuEnTranslator(),
    new AlphabeticalPurifier(),
    new KebabCaseFormatter(),
]);
echo $processor->process('Лорем ипсум долор сит амет'); // Output: "lorem-ipsum-dolor-sit-amet"
echo $processor->process('Привет, Мир!'); // Output: "privet-mir"
~~~

### Processors decoration
Each processor is a [decorator](https://en.wikipedia.org/wiki/Decorator_pattern). The [ProcessorInterface](https://github.com/Kolyunya/string-processor/blob/master/sources/ProcessorInterface.php) contains the `decorate` method:
~~~php
/**
 * Decorates supplied processor with the current processor.
 * @param ProcessorInterface $processor Processor to decorate.
 * @return ProcessorInterface Current processor.
 */
public function decorate(ProcessorInterface $processor);
~~~
That means that the above example can be implemented using processors decoration. The `Multiprocessor` usage is somewhat more readable though.
~~~php
$processor =
(new RuEnTranslator())->decorate(
    (new KebabCaseFormatter())->decorate(
        (new PunctuationStripper())
    )
);
echo $processor->process('Лорем ипсум долор сит амет'); // Output: "lorem-ipsum-dolor-sit-amet"
echo $processor->process('Привет, Мир!'); // Output: "privet-mir"
~~~

## Available processors
Currently the following processors are implemented:
* [Case switchers](https://github.com/Kolyunya/string-processor/blob/master/sources/Format/CaseSwitcher.php) - format strings to arbitrary formats.
    * [CamelCaseFormatter](https://github.com/Kolyunya/string-processor/blob/master/sources/Format/CamelCaseFormatter.php) - formats a string to the `CamelCase`.
    * [KebabCaseFormatter](https://github.com/Kolyunya/string-processor/blob/master/sources/Format/KebabCaseFormatter.php) - formats a string to the `kebab-case`.
    * [SnakeCaseFormatter](https://github.com/Kolyunya/string-processor/blob/master/sources/Format/SnakeCaseFormatter.php) - formats a string to the `snake_case`.
    * [UpperCaseFormatter](https://github.com/Kolyunya/string-processor/blob/master/sources/Format/UpperCaseFormatter.php) - formats a string to the `UPPER CASE`.
    * [LowerCaseFormatter](https://github.com/Kolyunya/string-processor/blob/master/sources/Format/LowerCaseFormatter.php) - formats a string to the `lower case`.
* [Translators](https://github.com/Kolyunya/string-processor/blob/master/sources/Translit/Translator.php) - transliterate strings from one language to another.
    * [RuEnTranslator](https://github.com/Kolyunya/string-processor/blob/master/sources/Translit/RuEnTranslator.php) - transliterates strings from Russian to English and the other way around.
* [Purifiers](https://github.com/Kolyunya/string-processor/blob/master/sources/Purify/BasePurifier.php) - purify strings.
    * [PunctuationStripper](https://github.com/Kolyunya/string-processor/blob/master/sources/Purify/PunctuationStripper.php) - Strips punctuation characters.
    * [AlphabeticalPurifier](https://github.com/Kolyunya/string-processor/blob/master/sources/Purify/AlphabeticalPurifier.php) - Strips non-alphabetical characters.
* [Multiprocessor](https://github.com/Kolyunya/string-processor/blob/master/sources/Multiprocessor.php) - combines multiple processors.

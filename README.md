# PHP string procession library

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

## Quick usage
You can use a processor without even instantiating it. The static `run($string)` method allows it. Note that the processor invoked in such way is default-initialized.
~~~php
echo KebabCaseFormatter::run('snake_case'); // Output: "snake-case"
~~~

## Combining multiple processors
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
* [CamelCaseFormatter](https://github.com/Kolyunya/string-processor/blob/master/sources/CaseSwitcher/CamelCaseFormatter.php) - formats a string to the `CamelCase`.
* [KebabCaseFormatter](https://github.com/Kolyunya/string-processor/blob/master/sources/CaseSwitcher/KebabCaseFormatter.php) - formats a string to the `kebab-case`.
* [SnakeCaseFormatter](https://github.com/Kolyunya/string-processor/blob/master/sources/CaseSwitcher/SnakeCaseFormatter.php) - formats a string to the `snake_case`.
* [UpperCaseFormatter](https://github.com/Kolyunya/string-processor/blob/master/sources/CaseSwitcher/UpperCaseFormatter.php) - formats a string to the `UPPER CASE`.
* [LowerCaseFormatter](https://github.com/Kolyunya/string-processor/blob/master/sources/CaseSwitcher/LowerCaseFormatter.php) - formats a string to the `lower case`.
* [Multiprocessor](https://github.com/Kolyunya/string-processor/blob/master/sources/Multiprocessor.php) - combines multiple processors.

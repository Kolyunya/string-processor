<?php

require 'vendor/autoload.php';

use Kolyunya\StringProcessor\KebabFormatter;

$processor = new KebabFormatter();

$camelCaseOriginal = 'SomeTextInCamelCase';
$camelCaseProcessed = $processor->process($camelCaseOriginal);
echo $camelCaseProcessed . "\n"; // "some-text-in-camel-case"

$underscoreCaseOriginal = 'some_text_in_underscore_case';
$underscoreCaseProcessed = $processor->process($underscoreCaseOriginal);
echo $underscoreCaseProcessed . "\n"; // "some-text-in-underscore-case"

$separateWordsOriginal = 'some separate words';
$separateWordsProcessed = $processor->process($separateWordsOriginal);
echo $separateWordsProcessed . "\n"; // "some-separate-words"

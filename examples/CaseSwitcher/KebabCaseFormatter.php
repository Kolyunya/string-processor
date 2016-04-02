<?php

require 'vendor/autoload.php';

use Kolyunya\StringProcessor\CaseSwitcher\KebabCaseFormatter;

$processor = new KebabCaseFormatter();

$camelCaseOriginal = 'SomeTextInCamelCase';
$camelCaseProcessed = $processor->process($camelCaseOriginal);
echo $camelCaseProcessed . "\n"; // "some-text-in-camel-case"

$snakeCaseOriginal = 'some_text_in_snake_case';
$snakeCaseProcessed = $processor->process($snakeCaseOriginal);
echo $snakeCaseProcessed . "\n"; // "some-text-in-snake-case"

$sentenceCaseOriginal = 'Some text in sentence case';
$sentenceCaseProcessed = $processor->process($sentenceCaseOriginal);
echo $sentenceCaseProcessed . "\n"; // "some-text-in-sentence-case"

$weirdCaseOriginal = '__Some_text -in    weird__case---';
$weirdCaseProcessed = $processor->process($weirdCaseOriginal);
echo $weirdCaseProcessed . "\n"; // "some-text-in-weird-case"

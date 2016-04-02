<?php

namespace Kolyunya\StringProcessor\CaseSwitcher;

use Kolyunya\StringProcessor\CaseSwitcher\KebabCaseFormatter;
use Kolyunya\StringProcessor\CaseSwitcher\SnakeCaseFormatter;
use Kolyunya\StringProcessor\CaseSwitcher\UpperCaseFormatter;
use Kolyunya\StringProcessor\Multiprocessor;
use Kolyunya\StringProcessor\ProcessorTestCase;

class MultiprocessorTest extends ProcessorTestCase
{
    public function testUpperKebabCase()
    {
        $this->processor = new Multiprocessor([
            new KebabCaseFormatter(),
            new UpperCaseFormatter(),
        ]);
        $this->performTest(
            'SomeTextInCamelCase',
            'SOME-TEXT-IN-CAMEL-CASE'
        );
    }

    public function testUpperSnakeCase()
    {
        $this->processor = new Multiprocessor([
            new SnakeCaseFormatter(),
            new UpperCaseFormatter(),
        ]);
        $this->performTest(
            'some-text-in-kebab-case',
            'SOME_TEXT_IN_KEBAB_CASE'
        );
    }

    /**
     * @inheritdoc
     */
    protected function performTest($sourceString, $processedStringExpected)
    {
        $this->performNonStaticTest($sourceString, $processedStringExpected);
    }
}

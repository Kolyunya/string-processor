<?php

namespace Kolyunya\StringProcessor;

use Kolyunya\StringProcessor\Format\KebabCaseFormatter;
use Kolyunya\StringProcessor\Format\SnakeCaseFormatter;
use Kolyunya\StringProcessor\Format\UpperCaseFormatter;
use Kolyunya\StringProcessor\Multiprocessor;
use Kolyunya\StringProcessor\ProcessorTestCase;

class MultiprocessorTest extends ProcessorTestCase
{
    /**
     * @inheritdoc
     */
    protected static $RUN_STATIC_TESTS = false;

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
}

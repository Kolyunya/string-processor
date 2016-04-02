<?php

namespace Kolyunya\StringProcessor\CaseSwitcher;

use Kolyunya\StringProcessor\CaseSwitcher\UpperCaseFormatter;
use Kolyunya\StringProcessor\ProcessorTestCase;

class UpperCaseFormatterTest extends ProcessorTestCase
{
    public function testFromKebabCase()
    {
        $this->performTest(
            'some-text-in-kebab-case',
            'SOME-TEXT-IN-KEBAB-CASE'
        );
    }

    public function testFromCamelCase()
    {
        $this->performTest(
            'SomeTextInCamelCase',
            'SOMETEXTINCAMELCASE'
        );
    }

    public function testFromSnakeCase()
    {
        $this->performTest(
            'some_text_in_snake_case',
            'SOME_TEXT_IN_SNAKE_CASE'
        );
    }

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();
        $this->processor = new UpperCaseFormatter();
    }
}

<?php

namespace Kolyunya\StringProcessor\CaseSwitcher;

use Kolyunya\StringProcessor\CaseSwitcher\LowerCaseFormatter;
use Kolyunya\StringProcessor\ProcessorTestCase;

class LowerCaseFormatterTest extends ProcessorTestCase
{
    public function testFromKebabCase()
    {
        $this->performTest(
            'SOME-TEXT-IN-KEBAB-CASE',
            'some-text-in-kebab-case'
        );
    }

    public function testFromCamelCase()
    {
        $this->performTest(
            'SomeTextInCamelCase',
            'sometextincamelcase'
        );
    }

    public function testFromSnakeCase()
    {
        $this->performTest(
            'SOME_TEXT_IN_SNAKE_CASE',
            'some_text_in_snake_case'
        );
    }

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();
        $this->processor = new LowerCaseFormatter();
    }
}

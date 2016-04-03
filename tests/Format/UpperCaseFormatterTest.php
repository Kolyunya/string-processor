<?php

namespace Kolyunya\StringProcessor\Format;

use Kolyunya\StringProcessor\Format\UpperCaseFormatter;
use Kolyunya\StringProcessor\ProcessorTestCase;

class UpperCaseFormatterTest extends ProcessorTestCase
{
    /**
     * @inheritdoc
     */
    public function processorTestsProvider()
    {
        return array(
            array(
                'some-text-in-kebab-case',
                'SOME-TEXT-IN-KEBAB-CASE'
            ),
            array(
                'SomeTextInCamelCase',
                'SOMETEXTINCAMELCASE'
            ),
            array(
                'some_text_in_snake_case',
                'SOME_TEXT_IN_SNAKE_CASE'
            ),
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

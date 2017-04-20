<?php

namespace Kolyunya\StringProcessor\Tests\Format;

use Kolyunya\StringProcessor\Format\LowerCaseFormatter;
use Kolyunya\StringProcessor\Tests\ProcessorTestCase;

class LowerCaseFormatterTest extends ProcessorTestCase
{
    /**
     * @inheritdoc
     */
    public function processorTestsProvider()
    {
        return array(
            array(
                'SOME-TEXT-IN-KEBAB-CASE',
                'some-text-in-kebab-case'
            ),
            array(
                'SomeTextInCamelCase',
                'sometextincamelcase'
            ),
            array(
                'SOME_TEXT_IN_SNAKE_CASE',
                'some_text_in_snake_case'
            ),
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

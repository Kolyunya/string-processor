<?php

namespace Kolyunya\StringProcessor\Tests\Format;

use Kolyunya\StringProcessor\Format\SnakeCaseFormatter;
use Kolyunya\StringProcessor\Tests\ProcessorTestCase;

class SnakeCaseFormatterTest extends ProcessorTestCase
{
    public function testFromKebabCase()
    {
        $this->performTest(
            'some-text-in-kebab-case',
            'some_text_in_kebab_case'
        );
    }

    public function testFromCamelCase()
    {
        $this->performTest(
            'SomeTextInCamelCase',
            'some_text_in_camel_case'
        );
    }

    public function testFromShortCamelCase()
    {
        $this->performTest(
            'Foo',
            'foo'
        );
    }

    public function testFromReallyShortCamelCase()
    {
        $this->performTest(
            'F',
            'f'
        );
    }

    public function testFromUnderscoreCase()
    {
        $this->performTest(
            'some_text_in_underscore_case',
            'some_text_in_underscore_case'
        );
    }

    public function testFromSeparateWords()
    {
        $this->performTest(
            'some separate words',
            'some_separate_words'
        );
    }

    public function testFromSeparateWordsWithSomeCapitalLetters()
    {
        $this->performTest(
            'Some Separate Words',
            'some_separate_words'
        );
    }

    public function testFromWeirdCase()
    {
        $this->performTest(
            'some-Really_weird Case',
            'some_really_weird_case'
        );
    }

    public function testFromStringWithMultipleUnderscores()
    {
        $this->performTest(
            'some__string__with__multiple__underscores',
            'some_string_with_multiple_underscores'
        );
    }

    public function testFromStringWithTrailingUnderscore()
    {
        $this->performTest(
            'string_with_a_trailing_underscore_',
            'string_with_a_trailing_underscore'
        );
    }

    public function testFromStringWithLeadingUnderscore()
    {
        $this->performTest(
            '_string_with_a_leading_underscore',
            'string_with_a_leading_underscore'
        );
    }

    public function testFromStringWithTrailingUnderscores()
    {
        $this->performTest(
            'string_with_a_trailing_underscores_____',
            'string_with_a_trailing_underscores'
        );
    }

    public function testFromStringWithLeadingUnderscores()
    {
        $this->performTest(
            '_____string_with_a_leading_underscores',
            'string_with_a_leading_underscores'
        );
    }

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        $this->processor = new SnakeCaseFormatter();
        parent::setUp();
    }
}

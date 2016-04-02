<?php

namespace Kolyunya\StringProcessor\CaseSwitcher;

use Kolyunya\StringProcessor\CaseSwitcher\KebabCaseFormatter;
use Kolyunya\StringProcessor\ProcessorTestCase;

class KebabCaseFormatterTest extends ProcessorTestCase
{
    public function testFromKebabCase()
    {
        $this->performTest(
            'some-text-in-kebab-case',
            'some-text-in-kebab-case'
        );
    }

    public function testFromCamelCase()
    {
        $this->performTest(
            'SomeTextInCamelCase',
            'some-text-in-camel-case'
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
            'some-text-in-underscore-case'
        );
    }

    public function testFromSeparateWords()
    {
        $this->performTest(
            'some separate words',
            'some-separate-words'
        );
    }

    public function testFromSeparateWordsWithSomeCapitalLetters()
    {
        $this->performTest(
            'Some Separate Words',
            'some-separate-words'
        );
    }

    public function testFromWeirdCase()
    {
        $this->performTest(
            'some-Really_weird Case',
            'some-really-weird-case'
        );
    }

    public function testFromStringWithMultipleUnderscores()
    {
        $this->performTest(
            'some__string__with__multiple__underscores',
            'some-string-with-multiple-underscores'
        );
    }

    public function testFromStringWithTrailingUnderscore()
    {
        $this->performTest(
            'string_with_a_trailing_underscore_',
            'string-with-a-trailing-underscore'
        );
    }

    public function testFromStringWithLeadingUnderscore()
    {
        $this->performTest(
            '_string_with_a_leading_underscore',
            'string-with-a-leading-underscore'
        );
    }

    public function testFromStringWithTrailingUnderscores()
    {
        $this->performTest(
            'string_with_a_trailing_underscores_____',
            'string-with-a-trailing-underscores'
        );
    }

    public function testFromStringWithLeadingUnderscores()
    {
        $this->performTest(
            '_____string_with_a_leading_underscores',
            'string-with-a-leading-underscores'
        );
    }

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        $this->processor = new KebabCaseFormatter();
        parent::setUp();
    }
}

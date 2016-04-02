<?php

namespace Kolyunya\StringProcessor\CaseSwitcher;

use Kolyunya\StringProcessor\CaseSwitcher\CamelCaseFormatter;
use Kolyunya\StringProcessor\ProcessorTestCase;

class CamelCaseFormatterTest extends ProcessorTestCase
{
    /**
     * @inheritdoc
     */
    protected function getTests()
    {
        return array(
            'snake_case' => 'SnakeCase',
        );
    }

    public function testFromKebabCase()
    {
        $this->performTest(
            'some-text-in-kebab-case',
            'SomeTextInKebabCase'
        );
    }

    public function testFromCamelCase()
    {
        $this->performTest(
            'SomeTextInCamelCase',
            'SomeTextInCamelCase'
        );
    }

    public function testFromShortCamelCase()
    {
        $this->performTest(
            'Foo',
            'Foo'
        );
    }

    public function testFromReallyShortCamelCase()
    {
        $this->performTest(
            'F',
            'F'
        );
    }

    public function testFromUnderscoreCase()
    {
        $this->performTest(
            'some_text_in_underscore_case',
            'SomeTextInUnderscoreCase'
        );
    }

    public function testFromSeparateWords()
    {
        $this->performTest(
            'some separate words',
            'SomeSeparateWords'
        );
    }

    public function testFromSeparateWordsWithSomeCapitalLetters()
    {
        $this->performTest(
            'Some Separate Words',
            'SomeSeparateWords'
        );
    }

    public function testFromWeirdCase()
    {
        $this->performTest(
            'some-Really_weird Case',
            'SomeReallyWeirdCase'
        );
    }

    public function testFromStringWithMultipleUnderscores()
    {
        $this->performTest(
            'some__string__with__multiple__underscores',
            'SomeStringWithMultipleUnderscores'
        );
    }

    public function testFromStringWithTrailingUnderscore()
    {
        $this->performTest(
            'string_with_a_trailing_underscore_',
            'StringWithATrailingUnderscore'
        );
    }

    public function testFromStringWithLeadingUnderscore()
    {
        $this->performTest(
            '_string_with_a_leading_underscore',
            'StringWithALeadingUnderscore'
        );
    }

    public function testFromStringWithTrailingUnderscores()
    {
        $this->performTest(
            'string_with_a_trailing_underscores_____',
            'StringWithATrailingUnderscores'
        );
    }

    public function testFromStringWithLeadingUnderscores()
    {
        $this->performTest(
            '_____string_with_a_leading_underscores',
            'StringWithALeadingUnderscores'
        );
    }

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();
        $this->processor = new CamelCaseFormatter();
    }
}

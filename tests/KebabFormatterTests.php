<?php

namespace Kolyunya\StringProcessor;

use Kolyunya\StringProcessor\KebabFormatter;
use Kolyunya\StringProcessor\ProcessorInterface;
use PHPUnit_Framework_TestCase;

class KebabFormatterTests extends PHPUnit_Framework_TestCase
{
    /**
     * Kebab formatter processor.
     * @var ProcessorInterface
     */
    private $processor;

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

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        $this->processor = new KebabFormatter();
    }

    /**
     * @inheritdoc
     */
    protected function tearDown()
    {
        unset($this->processor);
    }

    /**
     * Performs an arbitrary test.
     * @param string $sourceString Source string to process.
     * @param string $processedStringExpected Expected processed stirng.
     */
    private function performTest($sourceString, $processedStringExpected)
    {
        $processedStringActual = $this->processor->process($sourceString);
        $this->assertEquals($processedStringActual, $processedStringExpected);
    }
}

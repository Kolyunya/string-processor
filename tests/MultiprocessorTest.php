<?php

namespace Kolyunya\StringProcessor;

use Kolyunya\StringProcessor\Format\KebabCaseFormatter;
use Kolyunya\StringProcessor\Format\SnakeCaseFormatter;
use Kolyunya\StringProcessor\Format\UpperCaseFormatter;
use Kolyunya\StringProcessor\Multiprocessor;
use Kolyunya\StringProcessor\ProcessorTestCase;
use Kolyunya\StringProcessor\Purify\AlphabeticalPurifier;
use Kolyunya\StringProcessor\Purify\PunctuationStripper;
use Kolyunya\StringProcessor\Translit\RuEnTranslator;

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

    public function testKebabTranslitProcessor()
    {
        $this->processor = new Multiprocessor([
            new RuEnTranslator(),
            new KebabCaseFormatter(),
        ]);
        $this->performTest(
            'Лорем ипсум долор сит амет',
            'lorem-ipsum-dolor-sit-amet'
        );
    }

    public function testSlugGenerator001()
    {
        $this->processor = new Multiprocessor([
            new PunctuationStripper(),
            new RuEnTranslator(),
            new KebabCaseFormatter(),
        ]);
        $this->performTest(
            'Лорем ипсум долор сит амет',
            'lorem-ipsum-dolor-sit-amet'
        );
    }

    public function testSlugGenerator002()
    {
        $this->processor = new Multiprocessor([
            new PunctuationStripper(),
            new RuEnTranslator(),
            new KebabCaseFormatter(),
        ]);
        $this->performTest(
            'Привет, Мир!',
            'privet-mir'
        );
    }

    public function testSlugGenerator003()
    {
        $this->processor = new Multiprocessor([
            new AlphabeticalPurifier(),
            new RuEnTranslator(),
            new KebabCaseFormatter(),
        ]);
        $this->performTest(
            'Привет, Мир!',
            'privet-mir'
        );
    }

    public function testSlugGenerator004()
    {
        $this->processor = new Multiprocessor([
            new AlphabeticalPurifier(),
            new RuEnTranslator(),
            new KebabCaseFormatter(),
        ]);
        $this->performTest(
            'Привет, мир!',
            'privet-mir'
        );
    }
}

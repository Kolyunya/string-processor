<?php

namespace Kolyunya\StringProcessor\CaseSwitcher;

use Kolyunya\StringProcessor\Translit\Dictionary\RuEnDictionary;
use Kolyunya\StringProcessor\Translit\Translator;
use Kolyunya\StringProcessor\Tests\ProcessorTestCase;

class TranslatorTest extends ProcessorTestCase
{
    /**
     * @inheritdoc
     */
    protected static $RUN_STATIC_TESTS = false;

    /**
     * @inheritdoc
     */
    public function processorTestsProvider()
    {
        return array(
            array(
                'Привет, мир!',
                'Privet, mir!'
            ),
            array(
                'Прощай, жестокий мир...',
                'Proschay, zhestokiy mir...'
            ),
        );
    }

    public function testReversedTranslation001()
    {
        $this->processor->setDirection(Translator::DIRECTION_REVERSED);
        $this->performTest(
            'Privet, mir!',
            'Привет, мир!'
        );
    }

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();
        $dictionary = new RuEnDictionary();
        $this->processor = new Translator($dictionary);
    }
}

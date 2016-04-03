<?php

namespace Kolyunya\StringProcessor\CaseSwitcher;

use Kolyunya\StringProcessor\Translit\Dictionary\RuEnDictionary;
use Kolyunya\StringProcessor\Translit\Translator;
use Kolyunya\StringProcessor\ProcessorTestCase;

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

<?php

namespace Kolyunya\StringProcessor\Tests\Translit;

use Kolyunya\StringProcessor\Translit\RuEnTranslator;
use Kolyunya\StringProcessor\Tests\ProcessorTestCase;

class RuEnTranslatorTest extends ProcessorTestCase
{
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
        $this->processor = new RuEnTranslator();
    }
}

<?php

namespace Kolyunya\StringProcessor\Translit;

use Kolyunya\StringProcessor\Translit\Dictionary\RuEnDictionary;
use Kolyunya\StringProcessor\Translit\Translator;

/**
 * Translator.
 * @author Kolyunya
 */
class RuEnTranslator extends Translator
{
    /**
     * @inheritdoc
     */
    public function __construct()
    {
        $dictionary = new RuEnDictionary();
        parent::__construct($dictionary);
    }
}

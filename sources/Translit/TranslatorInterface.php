<?php

namespace Kolyunya\StringProcessor\Translit;

use Kolyunya\StringProcessor\ProcessorInterface;
use Kolyunya\StringProcessor\Translit\Dictionary\DictionaryInterface;

/**
 * Translator interface.
 * @author Kolyunya
 */
interface TranslatorInterface extends ProcessorInterface
{
    /**
     * Sets translation dictionary.
     * @param DictionaryInterface $dictionary Translation dictionary.
     */
    public function setDictionary(DictionaryInterface $dictionary);

    /**
     * Sets translation direction.
     * @param integer $direction Translation direction.
     */
    public function setDirection($direction);
}

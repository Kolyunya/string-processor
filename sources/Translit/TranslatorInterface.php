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
     * Constructs a translator specifying the dictionary.
     * @param DictionaryInterface $dictionary Translation dictionary.
     */
    public function __construct(DictionaryInterface $dictionary = null);

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

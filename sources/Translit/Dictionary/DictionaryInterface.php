<?php

namespace Kolyunya\StringProcessor\Translit\Dictionary;

/**
 * Translation dictionary interface.
 * @author Kolyunya
 */
interface DictionaryInterface
{
    /**
     * Returns an array of character substitutions.
     * @return array An array of character substitutions.
     */
    public function getSubstitutions();
}

<?php

namespace Kolyunya\StringProcessor\Purify;

use Kolyunya\StringProcessor\Purify\BasePurifier;

/**
 * Processor which strips all non-alphabetical characters.
 * @author Kolyunya
 */
class AlphabeticalPurifier extends BasePurifier
{
    /**
     * @inheritdoc
     */
    protected function getPattern()
    {
        $pattern = '/[^\s\p{L}]/u';
        return $pattern;
    }
}

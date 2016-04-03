<?php

namespace Kolyunya\StringProcessor\Purify;

use Kolyunya\StringProcessor\BaseProcessor;

/**
 * Processor which strips punctuation characters.
 * @author Kolyunya
 */
class PunctuationStripper extends BaseProcessor
{
    /**
     * @inheritdoc
     */
    public function process($string)
    {
        $string = preg_replace('/[[:punct:]]/', '', $string);
        return $string;
    }
}

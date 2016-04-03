<?php

namespace Kolyunya\StringProcessor\Format;

use Kolyunya\StringProcessor\BaseProcessor;

/**
 * Converts a string to an "UPPER CASE".
 * @author Kolyunya
 */
class UpperCaseFormatter extends BaseProcessor
{
    /**
     * @inheritdoc
     */
    public function process($string)
    {
        $string = mb_convert_case($string, MB_CASE_UPPER);
        return $string;
    }
}

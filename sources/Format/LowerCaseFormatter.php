<?php

namespace Kolyunya\StringProcessor\Format;

use Kolyunya\StringProcessor\BaseProcessor;

/**
 * Converts a string to a "lower case".
 * @author Kolyunya
 */
class LowerCaseFormatter extends BaseProcessor
{
    /**
     * @inheritdoc
     */
    protected function selfProcession($string)
    {
        $string = mb_convert_case($string, MB_CASE_LOWER);
        return $string;
    }
}

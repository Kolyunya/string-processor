<?php

namespace Kolyunya\StringProcessor\Purify;

use Kolyunya\StringProcessor\BaseProcessor;

/**
 * A base class for all string purifiers.
 * @author Kolyunya
 */
abstract class BasePurifier extends BaseProcessor
{
    /**
     * @inheritdoc
     */
    final public function process($string)
    {
        $pattern = $this->getPattern();
        $string = preg_replace($pattern, '', $string);
        return $string;
    }

    /**
     * Returns a regular expression pattern used to purify strings.
     * @return string A regular expression pattern used to purify strings.
     */
    abstract protected function getPattern();
}

<?php

namespace Kolyunya\StringProcessor\CaseSwitcher;

use Kolyunya\StringProcessor\CaseSwitcher\CaseSwitcher;
use Kolyunya\StringProcessor\ProcessorInterface;

/**
 * Converts a string to a "CamelCase".
 * @author Kolyunya
 */
class CamelFormatter extends CaseSwitcher implements ProcessorInterface
{
    /**
     * @inheritdoc
     */
    protected $destinationCase = self::CAMEL_CASE;

    /**
     * @inheritdoc
     */
    protected function processSnakeCase($string)
    {
        // Shift letters after underscores and
        // the first letter to the upper case.
        $pattern = '/(?<=^|_)[a-z]/';
        $callback = function ($matches) {
            $match = $matches[0];
            $replace = mb_convert_case($match, MB_CASE_UPPER);
            return $replace;
        };
        $string = preg_replace_callback($pattern, $callback, $string);

        // Remove all underscores.
        $string = str_replace('_', '', $string);

        return $string;
    }

    /**
     * @inheritdoc
     */
    protected function processKebabCase($string)
    {
        // Shift letters after hyphens and
        // the first letter to the upper case.
        $pattern = '/(?<=^|-)[a-z]/';
        $callback = function ($matches) {
            $match = $matches[0];
            $replace = mb_convert_case($match, MB_CASE_UPPER);
            return $replace;
        };
        $string = preg_replace_callback($pattern, $callback, $string);

        // Remove all hyphens.
        $string = str_replace('-', '', $string);

        return $string;
    }

    /**
     * @inheritdoc
     */
    protected function processSentenceCase($string)
    {
        // Shift letters after spaces and
        // the first letter to the upper case.
        $pattern = '/(?<=^| )[a-z]/';
        $callback = function ($matches) {
            $match = $matches[0];
            $replace = mb_convert_case($match, MB_CASE_UPPER);
            return $replace;
        };
        $string = preg_replace_callback($pattern, $callback, $string);

        // Remove all spaces.
        $string = str_replace(' ', '', $string);

        return $string;
    }

    /**
     * @inheritdoc
     */
    protected function processUndefinedCase($string)
    {
        $string = $this->processSnakeCase($string);
        $string = $this->processKebabCase($string);
        $string = $this->processSentenceCase($string);
        return $string;
    }
}

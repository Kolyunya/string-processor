<?php

namespace Kolyunya\StringProcessor;

use Kolyunya\StringProcessor\BaseProcessor;
use Kolyunya\StringProcessor\ProcessorInterface;

/**
 * Converts a string to a "kebabab-case".
 * @author Kolyunya
 */
class KebabFormatter extends BaseProcessor implements ProcessorInterface
{
    /**
     * @inheritdoc
     */
    public function process($string)
    {
        $this->processCamelCase($string);
        $this->processUnderscoreCase($string);
        $this->processSeparateWords($string);
        $this->removeDuplicateHyphens($string);
        return $string;
    }

    /**
     * Processes "CamelCase" formatted string.
     * @param stirng $string
     */
    private function processCamelCase(&$string)
    {
        // Add hyphens before each capital letter
        // which is not the first letter of the string.
        $pattern = '/(?<!^)[A-Z]/';
        $callback = function ($matches) {
            $match = $matches[0];
            $replace = "-$match";
            return $replace;
        };
        $string = preg_replace_callback($pattern, $callback, $string);

        // Convert the string to the lower case.
        $string = mb_convert_case($string, MB_CASE_LOWER);
    }

    /**
     * Processes "underscore_case" formatted string.
     * @param string $string
     */
    private function processUnderscoreCase(&$string)
    {
        // Replaces underscores with hyphens.
        $string = str_replace('_', '-', $string);
    }

    /**
     * Processes "separate words" formatted string.
     * @param string $string
     */
    private function processSeparateWords(&$string)
    {
        // Replace spaces with hyphens.
        $string = str_replace(' ', '-', $string);
    }

    /**
     * Removes duplicate hyphens which may occur
     * while parsing strings like "Some_Word_In_Strange_Case".
     * @param string $string
     */
    private function removeDuplicateHyphens(&$string)
    {
        while (strpos($string, '--') !== false) {
            $string = str_replace('--', '-', $string);
        }
    }
}

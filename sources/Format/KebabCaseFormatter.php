<?php

namespace Kolyunya\StringProcessor\Format;

use Kolyunya\StringProcessor\Format\CaseSwitcher;
use Kolyunya\StringProcessor\ProcessorInterface;

/**
 * Converts a string to a "kebabab-case".
 * @author Kolyunya
 */
class KebabCaseFormatter extends CaseSwitcher implements ProcessorInterface
{
    /**
     * @inheritdoc
     */
    protected $destinationCase = self::KEBAB_CASE;

    /**
     * @inheritdoc
     */
    protected function processSnakeCase($string)
    {
        // Replaces underscores with hyphens.
        $string = str_replace('_', '-', $string);

        return $string;
    }

    /**
     * @inheritdoc
     */
    protected function processCamelCase($string)
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

        return $string;
    }

    /**
     * @inheritdoc
     */
    protected function processSentenceCase($string)
    {
        // Replace spaces with hyphens.
        $string = str_replace(' ', '-', $string);

        // Convert the string to the lower case.
        $string = mb_convert_case($string, MB_CASE_LOWER);

        return $string;
    }

    /**
     * @inheritdoc
     */
    protected function processUndefinedCase($string)
    {
        $string = $this->processSnakeCase($string);
        $string = $this->processCamelCase($string);
        $string = $this->processSentenceCase($string);
        $string = $this->removeDuplicateHyphens($string);
        $string = $this->removeTailHyphens($string);
        return $string;
    }

    /**
     * Removes duplicate hyphens which will occur while
     * parsing strings like "Some_Word_In_Strange_Case".
     * @param string $string String to process.
     * @return string String with no duplicate hyphens.
     */
    private function removeDuplicateHyphens($string)
    {
        // Keep removing duplicate hyphens while they are present.
        while (strpos($string, '--') !== false) {
            $string = str_replace('--', '-', $string);
        }

        return $string;
    }

    /**
     * Removes tail hyphens.
     * @param string $string String to process.
     * @return string String with no tail hyphens.
     */
    private function removeTailHyphens($string)
    {
        // Keep removing tail hyphens while they are present.
        $pattern = '/(^-)|(-$)/';
        while (preg_match($pattern, $string) === 1) {
            $string = preg_replace($pattern, '', $string);
        }

        return $string;
    }
}

<?php

namespace Kolyunya\StringProcessor\CaseSwitcher;

use Kolyunya\StringProcessor\CaseSwitcher\CaseSwitcher;
use Kolyunya\StringProcessor\ProcessorInterface;

/**
 * Converts a string to a "snake_case".
 * @author Kolyunya
 */
class SnakeCase extends CaseSwitcher implements ProcessorInterface
{
    /**
     * @inheritdoc
     */
    protected $destinationCase = self::SNAKE_CASE;

    /**
     * @inheritdoc
     */
    protected function processCamelCase($string)
    {
        // Add underscores before each capital letter
        // which is not the first letter of the string.
        $pattern = '/(?<!^)[A-Z]/';
        $callback = function ($matches) {
            $match = $matches[0];
            $replace = "_$match";
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
    protected function processKebabCase($string)
    {
        // Replaces hyphens with underscores.
        $string = str_replace('-', '_', $string);

        return $string;
    }

    /**
     * @inheritdoc
     */
    protected function processSentenceCase($string)
    {
        // Replace spaces with underscores.
        $string = str_replace(' ', '_', $string);

        // Convert the string to the lower case.
        $string = mb_convert_case($string, MB_CASE_LOWER);

        return $string;
    }

    /**
     * @inheritdoc
     */
    protected function processUndefinedCase($string)
    {
        $string = $this->processCamelCase($string);
        $string = $this->processKebabCase($string);
        $string = $this->processSentenceCase($string);
        $string = $this->removeDuplicateUnderscores($string);
        $string = $this->removeTailUnderscores($string);
        return $string;
    }

    /**
     * Removes duplicate underscores which will occur while
     * parsing strings like "Some-Word-In-Strange-Case".
     * @param string $string String to process.
     * @return string String with no duplicate underscores.
     */
    private function removeDuplicateUnderscores($string)
    {
        // Keep removing duplicate underscores while they are present.
        while (strpos($string, '__') !== false) {
            $string = str_replace('__', '_', $string);
        }

        return $string;
    }

    /**
     * Removes tail underscores.
     * @param string $string String to process.
     * @return string String with no tail underscores.
     */
    private function removeTailUnderscores($string)
    {
        // Keep removing tail underscores while they are present.
        $pattern = '/(^_)|(_$)/';
        while (preg_match($pattern, $string) === 1) {
            $string = preg_replace($pattern, '', $string);
        }

        return $string;
    }
}

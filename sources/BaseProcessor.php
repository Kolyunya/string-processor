<?php

namespace Kolyunya\StringProcessor;

use Kolyunya\StringProcessor\ProcessorInterface;

/**
 * Base processor of all processors.
 * @author Kolyunya
 */
abstract class BaseProcessor implements ProcessorInterface
{
    /**
     * Processes a string with a default-initialized instance of the processor
     * and returns a processed version of the original string.
     * @param string $string A string to process.
     * @return string A processed version of the original string.
     */
    public static function staticProcess($string)
    {
        $processorClass = get_called_class();
        $processor = new $processorClass();
        $processedString = $processor->process($string);
        return $processedString;
    }
}

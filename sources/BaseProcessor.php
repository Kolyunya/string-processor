<?php

namespace Kolyunya\StringProcessor;

use Kolyunya\StringProcessor\ProcessorInterface;
use ReflectionClass;

/**
 * Base processor of all processors.
 * @author Kolyunya
 */
abstract class BaseProcessor implements ProcessorInterface
{
    /**
     * Processes a string and returns a processed version of the original string.
     * @param string $string A string to process.
     * @param object|array $parameters Parameters passed to the processor's constructor.
     * @return string A processed version of the original string.
     */
    public static function run($string, $parameters = array())
    {
        if (!is_array($parameters)) {
            $parameters = array($parameters);
        }
        $processorClass = get_called_class();
        $processorReflection = new ReflectionClass($processorClass);
        $processor = $processorReflection->newInstanceArgs($parameters);
        $processedString = $processor->process($string);
        return $processedString;
    }
}

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
     * Processor to decorate.
     * @var ProcessorInterface
     */
    private $child;

    /**
     * Processes a string and returns a processed version of the original string.
     * @param string $string A string to process.
     * @param object|array $parameters Parameters passed to the processor's constructor.
     * @param string $encoding Default encoding.
     * @return string A processed version of the original string.
     */
    public static function run($string, $parameters = array(), $encoding = 'UTF-8')
    {
        if (!is_array($parameters)) {
            $parameters = array($parameters);
        }
        mb_internal_encoding($encoding);
        mb_regex_encoding($encoding);
        $processorClass = get_called_class();
        $processorReflection = new ReflectionClass($processorClass);
        $processor = $processorReflection->newInstanceArgs($parameters);
        $processedString = $processor->process($string);
        return $processedString;
    }

    /**
     * @inheritdoc
     */
    public function decorate(ProcessorInterface $processor)
    {
        $this->child = $processor;
        return $this;
    }

    /**
     * @inheritdoc
     */
    final public function process($string)
    {
        $string = $this->childProcession($string);
        $string = $this->selfProcession($string);
        return $string;
    }

    /**
     * Processes the string with the current processor.
     * @param string $string String to process.
     * @return string Processed string.
     */
    abstract protected function selfProcession($string);

    /**
     * Processes the string with the child processor if it's specified.
     * @param string $string String to process.
     * @return string Processed string.
     */
    private function childProcession($string)
    {
        if ($this->child !== null) {
            $string = $this->child->process($string);
        }
        return $string;
    }
}

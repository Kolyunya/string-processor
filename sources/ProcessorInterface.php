<?php

namespace Kolyunya\StringProcessor;

/**
 * Interface of a generic string processor.
 * @author Kolyunya
 */
interface ProcessorInterface
{
    /**
     * Processes a string and returns a processed version of the original string.
     * @param string $string A string to process.
     * @return string A processed version of the original string.
     */
    public function process($string);

    /**
     * Decorates supplied processor with the current processor.
     * @param ProcessorInterface $processor Processor to decorate.
     * @return ProcessorInterface Current processor.
     */
    public function decorate(ProcessorInterface $processor);
}

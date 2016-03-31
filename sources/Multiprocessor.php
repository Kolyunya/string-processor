<?php

namespace Kolyunya\StringProcessor;

use Kolyunya\StringProcessor\BaseProcessor;
use Kolyunya\StringProcessor\ProcessorInterface;

class Multiprocessor extends BaseProcessor implements ProcessorInterface
{
    /**
     * An array of processors to use while procession.
     * @var array
     */
    private $processors;

    /**
     * Initializes the multiprocessor.
     * @param array $processors Processors to use while procession.
     */
    public function __construct($processors = array())
    {
        $this->processors = $processors;
    }

    /**
     * Adds a processor to an array of processors used while procession.
     * @param ProcessorInterface $processor Processor to add.
     */
    public function addProcessor(ProcessorInterface $processor)
    {
        $this->processors[] = $processor;
    }

    /**
     * @inheritdoc
     */
    public function process($string)
    {
        foreach ($this->processors as $processor) {
            $string = $processor->process($string);
        }
        return $string;
    }
}

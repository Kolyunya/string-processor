<?php

namespace Kolyunya\StringProcessor;

use Kolyunya\StringProcessor\ProcessorInterface;
use PHPUnit_Framework_TestCase;

class ProcessorTestCase extends PHPUnit_Framework_TestCase
{
    /**
     * String processor.
     * @var ProcessorInterface
     */
    protected $processor;

    /**
     * @inheritdoc
     */
    protected function tearDown()
    {
        parent::tearDown();
        unset($this->processor);
    }

    /**
     * Runs a string processor test.
     * @param string $sourceString Source string to process.
     * @param string $processedStringExpected Expected processed stirng.
     */
    protected function performTest($sourceString, $processedStringExpected)
    {
        $this->performNonStaticeTst($sourceString, $processedStringExpected);
        $this->performStaticTest($sourceString, $processedStringExpected);
    }

    /**
     * Performs an arbitrary test using processor instance.
     * @param string $sourceString Source string to process.
     * @param string $processedStringExpected Expected processed stirng.
     */
    protected function performNonStaticeTst($sourceString, $processedStringExpected)
    {
        $processedStringActual = $this->processor->process($sourceString);
        $this->assertEquals($processedStringExpected, $processedStringActual);
    }

    /**
     * Performs an arbitrary test without instantiating a processor instance.
     * @param string $sourceString Source string to process.
     * @param string $processedStringExpected Expected processed stirng.
     */
    protected function performStaticTest($sourceString, $processedStringExpected)
    {
        $processorClassName = get_class($this->processor);
        $processorMethod = array($processorClassName, 'run');
        $processedStringActual = forward_static_call($processorMethod, $sourceString);
        $this->assertEquals($processedStringExpected, $processedStringActual);
    }
}

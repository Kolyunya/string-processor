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
     * Tests a string processoor.
     * @param string $sourceString Source string to process.
     * @param string $processedStringExpected Expected processed stirng.
     * @dataProvider processorTestsProvider
     */
    public function testProcessor($sourceString, $processedStringExpected)
    {
        if ($sourceString && $processedStringExpected) {
            $this->performTest($sourceString, $processedStringExpected);
        }
    }

    /**
     * Data provider for string processor tests
     * @return array
     */
    public function processorTestsProvider()
    {
        return array(
            array(
                null,
                null,
            )
        );
    }

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
        $this->performNonStaticTest($sourceString, $processedStringExpected);
        $this->performStaticTest($sourceString, $processedStringExpected);
    }

    /**
     * Performs an arbitrary test using processor instance.
     * @param string $sourceString Source string to process.
     * @param string $processedStringExpected Expected processed stirng.
     */
    protected function performNonStaticTest($sourceString, $processedStringExpected)
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

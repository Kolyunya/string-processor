<?php

namespace Kolyunya\StringProcessor\Format;

use Exception;
use Kolyunya\StringProcessor\BaseProcessor;
use Kolyunya\StringProcessor\Format\CaseSwitcherInterface;

/**
 * A base class for all case switchers.
 * @author Kolyunya
 */
abstract class CaseSwitcher extends BaseProcessor implements CaseSwitcherInterface
{
    /**
     * A constant for an undefined case.
     */
    const UNDEFINED_CASE = 0x00;

    /**
     * A constant for a "snake_case".
     */
    const SNAKE_CASE = 0x01;

    /**
     * A constant for a "CamelCase".
     */
    const CAMEL_CASE = 0x02;

    /**
     * A constant for a "kebab-case".
     */
    const KEBAB_CASE = 0x03;

    /**
     * A constant for a "Sentence case".
     */
    const SENTENCE_CASE = 0x04;

    /**
     * Source case of the string.
     * @var integer
     */
    protected $sourceCase = self::UNDEFINED_CASE;

    /**
     * Destination case of the string.
     * @var integer
     */
    protected $destinationCase = self::UNDEFINED_CASE;

    /**
     * @inheritdoc
     */
    public function setSourceCase($sourceCase)
    {
        $this->sourceCase = $sourceCase;
    }

    /**
     * @inheritdoc
     */
    public function process($string)
    {
        // Check whether the destination string case is already reached.
        if ($this->destinationCaseIsReached()) {
            return $string;
        }

        // Perform actual procession depending on the source case.
        switch ($this->sourceCase) {
            case self::SNAKE_CASE:
                $string = $this->processSnakeCase($string);
                break;
            case self::CAMEL_CASE:
                $string = $this->processCamelCase($string);
                break;
            case self::KEBAB_CASE:
                $string = $this->processKebabCase($string);
                break;
            case self::SENTENCE_CASE:
                $string = $this->processSentenceCase($string);
                break;
            default:
                $string = $this->processUndefinedCase($string);
        }

        return $string;
    }

    /**
     * Processes a string in an "snake_case".
     * Override this function in actual formatters.
     * @param string $string String to process.
     * @return string Processed string.
     */
    protected function processSnakeCase($string)
    {
        $this->throwProcessionException();
    }

    /**
     * Processes a string in an "CamelCase".
     * Override this function in actual formatters.
     * @param string $string String to process.
     * @return string Processed string.
     */
    protected function processCamelCase($string)
    {
        $this->throwProcessionException();
    }

    /**
     * Processes a string in an "kebab-case".
     * Override this function in actual formatters.
     * @param string $string String to process.
     * @return string Processed string.
     */
    protected function processKebabCase($string)
    {
        $this->throwProcessionException();
    }

    /**
     * Processes a string in an "Sentence case".
     * Override this function in actual formatters.
     * @param string $string String to process.
     * @return string Processed string.
     */
    protected function processSentenceCase($string)
    {
        $this->throwProcessionException();
    }

    /**
     * Processes a string in an undefined case.
     * Override this function in actual formatters.
     * @param string $string String to process.
     * @return string Processed string.
     */
    protected function processUndefinedCase($string)
    {
        $this->throwProcessionException();
    }

    /**
     * Checks whether the destination string case is already reached.
     * @return boolean Indicates whether the destination string case is already reached.
     */
    private function destinationCaseIsReached()
    {
        $casesAreEqual = $this->sourceCase === $this->destinationCase;
        $casesAreKnown = $this->sourceCase !== self::UNDEFINED_CASE;
        $destinationCaseIsReached = $casesAreEqual && $casesAreKnown;
        return $destinationCaseIsReached;
    }

    /**
     * Throws a string procession exception.
     * @throws Exception
     */
    private function throwProcessionException()
    {
        $message = 'String procession failed.';
        $exception = new Exception($message);
        throw $exception;
    }
}

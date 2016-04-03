<?php

namespace Kolyunya\StringProcessor\Translit;

use Kolyunya\StringProcessor\BaseProcessor;
use Kolyunya\StringProcessor\Translit\Dictionary\DictionaryInterface;
use Kolyunya\StringProcessor\Translit\TranslatorInterface;

/**
 * Translator.
 * @author Kolyunya
 */
class Translator extends BaseProcessor implements TranslatorInterface
{
    /**
     * Forward translation direction.
     */
    const DIRECTION_FORWARD = 0x00;

    /**
     * Reversed translation direction.
     */
    const DIRECTION_REVERSED = 0x01;

    /**
     * Translation dictionary.
     * @var DictionaryInterface
     */
    private $dictionary;

    /**
     * Translation direction.
     * @var integer
     */
    private $direction;

    /**
     * @inheritdoc
     */
    public function __construct(DictionaryInterface $dictionary = null)
    {
        $this->setDictionary($dictionary);
        $this->setDirection(self::DIRECTION_FORWARD);
    }

    /**
     * @inheritdoc
     */
    public function setDictionary(DictionaryInterface $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    /**
     * @inheritdoc
     */
    public function setDirection($direction)
    {
        $this->direction = $direction;
    }

    /**
     * @inheritdoc
     */
    public function process($string)
    {
        $string = $this->substituteCharacters($string);
        return $string;
    }

    /**
     * Substitutes characters in a string.
     * @param string $string String to substitute characters in.
     * @return string String with substituted characters.
     */
    private function substituteCharacters($string)
    {
        $substitutions = $this->dictionary->getSubstitutions();
        foreach ($substitutions as $from => $to) {
            if ($this->direction === self::DIRECTION_FORWARD) {
                $pattern = "/$from/u";
                $replacement = $to;
            } else {
                $pattern = "/$to/u";
                $replacement = $from;
            }
            $string = preg_replace($pattern, $replacement, $string);
        }
        return $string;
    }
}

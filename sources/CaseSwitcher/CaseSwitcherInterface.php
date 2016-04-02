<?php

namespace Kolyunya\StringProcessor\CaseSwitcher;

use Kolyunya\StringProcessor\ProcessorInterface;

/**
 * Case switchers interface.
 * @author Kolyunya
 */
interface CaseSwitcherInterface extends ProcessorInterface
{
    /**
     * Sets source case of the string.
     * @param integer $sourceCase
     */
    public function setSourceCase($sourceCase);
}

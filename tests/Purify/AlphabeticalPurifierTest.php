<?php

namespace Kolyunya\StringProcessor\Tests\Purify;

use Kolyunya\StringProcessor\Purify\AlphabeticalPurifier;
use Kolyunya\StringProcessor\Tests\ProcessorTestCase;

class AlphabeticalPurifierTest extends ProcessorTestCase
{
    public function testFromCleanString001()
    {
        $this->performTest(
            'foobarbaz',
            'foobarbaz'
        );
    }

    public function testFromCleanString002()
    {
        $this->performTest(
            'foo bar baz',
            'foo bar baz'
        );
    }

    public function testFromUnderscores001()
    {
        $this->performTest(
            'foo_bar_baz',
            'foobarbaz'
        );
    }

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();
        $this->processor = new AlphabeticalPurifier();
    }
}

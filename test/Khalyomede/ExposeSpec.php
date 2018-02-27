<?php

namespace test\Khalyomede;

use Khalyomede\Expose;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use InvalidArgumentException;

class ExposeSpec extends ObjectBehavior
{
    function it_is_initializable() {
        $this->shouldHaveType(Expose::class);
    }

    function it_should_prevent_exposing_existing_function() {
    	$this->shouldThrow('InvalidArgumentException')->during('make', ['sprintf', 'sprintf']);
    }
}

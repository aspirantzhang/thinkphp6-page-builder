<?php

declare(strict_types=1);

namespace aspirantzhang\test\octopusPageBuilder;

use aspirantzhang\octopusPageBuilder\Builder;

class ElementBuilderTest extends TestCase
{
    public function testEmptyParamsShouldReturnDefaultValue()
    {
        $actual = Builder::element()->singleChoice();
        $expected = [
            [
                'title' => 'Valid translation',
                'value' => 1,
            ],
            [
                'title' => 'Valid translation',
                'value' => 0,
            ],
        ];
        $this->assertEqualsCanonicalizing($expected, $actual);
    }

    public function testValidParamsShouldReturnCorrectResult()
    {
        $actual = Builder::element()->singleChoice('Unit', 'Test');
        $expected = [
            [
                'title' => 'Valid translation',
                'value' => 1,
            ],
            [
                'title' => 'Valid translation',
                'value' => 0,
            ],
        ];
        $this->assertEqualsCanonicalizing($expected, $actual);
    }
}

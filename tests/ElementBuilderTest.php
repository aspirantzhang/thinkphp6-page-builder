<?php

declare(strict_types=1);

namespace aspirantzhang\test\antdBuilder;

use aspirantzhang\TPAntdBuilder\Builder;

class ElementBuilderTest extends TestCase
{
    public function testEmptyParamsShouldReturnDefaultValue()
    {
        $actual = Builder::element()->singleChoice();
        $expected = [
            [
                'title' => 'Enabled',
                'value' => 1,
            ],
            [
                'title' => 'Disabled',
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
                'title' => 'Unit',
                'value' => 1,
            ],
            [
                'title' => 'Test',
                'value' => 0,
            ],
        ];
        $this->assertEqualsCanonicalizing($expected, $actual);
    }
}

<?php

declare(strict_types=1);

namespace aspirantzhang\test\octopusPageBuilder;

use aspirantzhang\octopusPageBuilder\Common;
use aspirantzhang\octopusPageBuilder\Builder;

class CommonTest extends TestCase
{
    public function testCleanArrayElementIfValuesIsArray()
    {
        $actual = (new Common())->cleanArrayElement([
            'type-string' => 'string',
            'type-value' => 1,
            'type-zero' => 0,
            'type-empty-string' => '',
            'type-null' => null,
            'type-empty-array' => []
        ]);
        $expected = [
            'type-string' => 'string',
            'type-value' => 1,
            'type-zero' => 0,
        ];
        $this->assertEqualsCanonicalizing($expected, $actual);
    }
    public function testCleanArrayElementIfValuesIsObject()
    {
        $actual = (new Common())->cleanArrayElement(
            Builder::field('test')->type('input')->data([])
        );
        $expected = [
            'name' => 'test',
            'title' => 'Valid translation',
            'type' => 'input'
        ];
        $this->assertEqualsCanonicalizing($expected, $actual);
    }

    public function testCleanChildrenEmptyValues()
    {
        $actual = (new Common())->cleanChildrenEmptyValues(
            [
                [
                    'type-string' => 'string',
                    'type-value' => 1,
                    'type-zero' => 0,
                    'type-empty-string' => '',
                    'type-null' => null,
                    'type-empty-array' => []
                ],
                Builder::field('test')->type('input')->data([]),
            ]
        );
        $expected = [
            [
                'type-string' => 'string',
                'type-value' => 1,
                'type-zero' => 0,
            ],
            [
                'name' => 'test',
                'title' => 'Valid translation',
                'type' => 'input'
            ]
        ];
        $this->assertEqualsCanonicalizing($expected, $actual);
    }
}

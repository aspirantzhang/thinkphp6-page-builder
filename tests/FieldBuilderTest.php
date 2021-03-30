<?php

declare(strict_types=1);

namespace aspirantzhang\test\antdBuilder;

use aspirantzhang\TPAntdBuilder\Builder;

class FieldBuilderTest extends \PHPUnit\Framework\TestCase
{
    public function testEmptyParamsShouldReturnInitSchema()
    {
        $actual = Builder::field('');
        $expected = [
            'name' => '',
            'title' => '',
            'type' => 'text',
            'data' => [],
            'hideInColumn' => null,
            'sorter' => null,
            'editDisabled' => null,
            'mode' => null
        ];
        $this->assertEqualsCanonicalizing($expected, (array)$actual);
    }

    public function testValidParamsShouldReturnCorrectResult()
    {
        $actual = (array)Builder::field('unitTest', 'Unit Test')
                ->type('switch')
                ->sorter(true)
                ->editDisabled(true)
                ->hideInColumn(true)
                ->mode('multiple')
                ->data(['unitTestData']);
        $expected = [
            'name' => 'unitTest',
            'title' => 'Unit Test',
            'type' => 'switch',
            'data' => ['unitTestData'],
            'sorter' => true,
            'editDisabled' => true,
            'hideInColumn' => true,
            'mode' => 'multiple',
        ];
        $this->assertEqualsCanonicalizing($expected, $actual);
    }
}

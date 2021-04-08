<?php

declare(strict_types=1);

namespace aspirantzhang\test\antdBuilder;

use aspirantzhang\TPAntdBuilder\Builder;

class FieldBuilderTest extends TestCase
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

    public function testMoreFieldType()
    {
        $selectActual = (array)Builder::field('unitTest', 'Unit Test')
                ->type('select');
        $selectExpected = [
            'name' => 'unitTest',
            'title' => 'Unit Test',
            'type' => 'select',
            'data' => [],
            'hideInColumn' => null,
            'sorter' => null,
            'editDisabled' => null,
            'mode' => 'multiple',
        ];
        $this->assertEqualsCanonicalizing($selectExpected, $selectActual);

        $trashActual = (array)Builder::field('unitTest', 'Unit Test')
                ->type('trash');
        $trashExpected = [
            'name' => 'unitTest',
            'title' => 'Unit Test',
            'type' => 'select',
            'data' => [
                        [
                            'title' => 'Only Trashed',
                            'value' => 'onlyTrashed'
                        ],
                        [
                            'title' => 'With Trashed',
                            'value' => 'withTrashed'
                        ],
                        [
                            'title' => 'Without Trashed',
                            'value' => 'withoutTrashed'
                        ],
                    ],
            'hideInColumn' => true,
            'sorter' => null,
            'editDisabled' => null,
            'mode' => ''
        ];
        $this->assertEqualsCanonicalizing($trashExpected, $trashActual);

        $actionsActual = (array)Builder::field('actions', 'Unit Test Action');
        $actionsExpected = [
            'name' => 'actions',
            'title' => 'Unit Test Action',
            'type' => 'actions',
            'data' => [],
            'hideInColumn' => null,
            'sorter' => null,
            'editDisabled' => null,
            'mode' => null,
        ];
        $this->assertEqualsCanonicalizing($actionsExpected, $actionsActual);
    }

    public function testUnknownFieldType()
    {
        $actual = (array)Builder::field('unitTest', 'Unit Test')
                ->type('whatever');

        $expected = [
            'name' => 'unitTest',
            'title' => 'Unit Test',
            'type' => 'whatever',
            'data' => [],
            'hideInColumn' => null,
            'sorter' => null,
            'editDisabled' => null,
            'mode' => null
        ];
        $this->assertEqualsCanonicalizing($expected, $actual);
    }
}

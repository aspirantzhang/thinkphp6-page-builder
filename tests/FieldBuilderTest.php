<?php

declare(strict_types=1);

namespace aspirantzhang\test\octopusPageBuilder;

use aspirantzhang\octopusPageBuilder\Builder;

class FieldBuilderTest extends TestCase
{
    public function testEmptyParamsShouldReturnInitSchema()
    {
        $actual = Builder::field('');
        $expected = [
            'name' => '',
            'title' => 'Valid translation',
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
                ->listSorter(true)
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

    public function testLanguageParse()
    {
        $actual = (array)Builder::field('model.unitTest')
                ->type('switch')
                ->listSorter(true)
                ->editDisabled(true)
                ->hideInColumn(true)
                ->mode('multiple')
                ->data(['unitTestData']);
        $expected = [
            'name' => 'unitTest',
            'title' => 'Valid translation',
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
                            'title' => 'Valid translation',
                            'value' => 'onlyTrashed'
                        ],
                        [
                            'title' => 'Valid translation',
                            'value' => 'withTrashed'
                        ],
                        [
                            'title' => 'Valid translation',
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

        $i18nActual = (array)Builder::field('i18n', 'Unit Test I18n')->type('i18n');
        $i18nExpected = [
            'name' => 'i18n',
            'title' => 'Unit Test I18n',
            'type' => 'i18n',
            'data' => 'Valid Config',
            'hideInColumn' => null,
            'sorter' => null,
            'editDisabled' => null,
            'mode' => null,
        ];

        $this->assertEqualsCanonicalizing($i18nExpected, $i18nActual);
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

    public function testTitleFieldConfig()
    {
        $actual = (array)Builder::field('test', 'Test')
                ->type('input')
                ->titleField(true);

        $expected = [
            'name' => 'test',
            'title' => 'Test',
            'type' => 'input',
            'data' => [],
            'hideInColumn' => null,
            'sorter' => null,
            'editDisabled' => null,
            'mode' => null,
            'titleField' => true
        ];
        $this->assertEqualsCanonicalizing($expected, $actual);
    }

    public function testToArray()
    {
        $instance = Builder::field('test', 'Test')->type('input')->toArray();

        $this->assertEquals('array', gettype($instance));
    }

    public function testSetTargetVisible()
    {
        $actual = Builder::field('unit test')->setTargetVisible([
            'value1' => ['key1', 'key2'],
            'value2' => ['key3']
        ])->toArray();
        $expected = [
            'name' => 'unit test',
            'title' => 'Valid translation',
            'type' => 'text',
            'data' => [],
            'hideInColumn' => null,
            'sorter' => null,
            'editDisabled' => null,
            'mode' => null,
            'reactions' => [
                'type' => 'active',
                'property' => 'visible',
                'conditions' => [
                    [
                        'target' => ['key1', 'key2'],
                        'when' => 'value1',
                    ],
                    [
                        'target' => ['key3'],
                        'when' => 'value2'
                    ]
                ]
            ]
        ];
        $this->assertEqualsCanonicalizing($actual, $expected);
    }

    public function testSetMyVisible()
    {
        $actual = Builder::field('unit test')->setMyVisible([
            'field1' => 'value1',
            'field2' => ['value2', 'value3']
        ])->toArray();
        $expected = [
            'name' => 'unit test',
            'title' => 'Valid translation',
            'type' => 'text',
            'data' => [],
            'hideInColumn' => null,
            'sorter' => null,
            'editDisabled' => null,
            'mode' => null,
            'reactions' => [
                'type' => 'passive',
                'property' => 'visible',
                'conditions' => [
                    [
                        'dependency' => 'field1',
                        'when' => 'value1',
                    ],
                    [
                        'dependency' => 'field2',
                        'when' => ['value2', 'value3']
                    ]
                ]
            ]
        ];
        $this->assertEqualsCanonicalizing($actual, $expected);
    }
}

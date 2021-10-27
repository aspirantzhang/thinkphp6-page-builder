<?php

declare(strict_types=1);

namespace aspirantzhang\test\octopusPageBuilder;

use aspirantzhang\octopusPageBuilder\Builder;

class PageBuilderTest extends TestCase
{
    public function testPageBuilderInitSchema()
    {
        $actual = Builder::page('page-name')->toArray();
        $expected = [
            'page' => [
                'name' => 'page-name',
                'title' => ''
            ],
        ];
        $this->assertEqualsCanonicalizing($expected, $actual);
    }

    public function testDefaultValueWhenAddingRecords()
    {
        $actual = Builder::page('model-name.model-add')->toArray();
        $expected = [
            'page' => [
                'name' => 'model-add',
                'title' => 'Valid translation',
                'options' => [
                    'revision' => false
                ]
            ],
        ];
        $this->assertEqualsCanonicalizing($expected, $actual);
    }

    public function testValidParamsShouldReturnCorrectResult()
    {
        $actual = Builder::page('unit-test-page', 'Unit Test Page')->type('unitTestType')
                ->options([
                    'search' => true,
                    'revision' => false,
                ])
                ->tableToolBar(['tableToolBar'])
                ->batchToolBar(['batchToolBar'])
                ->tableColumn(['tableColumn'])
                ->tab('unit-test-tab-1', ['tab1'], 'Unit Test Tab 1')
                ->tab('unit-test-tab-2', ['tab2'], 'Unit Test Tab 2')
                ->sidebar('unit-test-sidebar-1', ['sidebar1'], 'Unit Test Sidebar 1')
                ->sidebar('unit-test-sidebar-2', ['sidebar2'], 'Unit Test Sidebar 2')
                ->action('unit-test-action-1', ['action1'], 'Unit Test Action 1')
                ->action('unit-test-action-2', ['action2'], 'Unit Test Action 2')
                ->toArray();
        $expected = [
            'page' => [
                'name' => 'unit-test-page',
                'title' => 'Unit Test Page',
                'type' => 'unitTestType',
                'options' => [
                    'search' => true,
                    'revision' => false,
                ]
            ],
            'layout' => [
                'tableToolbar' => ['tableToolBar'],
                'batchToolBar' => ['batchToolBar'],
                'tableColumn' => ['tableColumn'],
                'tabs' => [
                    [ 'name' => 'unit-test-tab-1', 'title' => 'Unit Test Tab 1', 'data' => ['tab1'] ],
                    [ 'name' => 'unit-test-tab-2', 'title' => 'Unit Test Tab 2', 'data' => ['tab2'] ],
                ],
                'sidebars' => [
                    [ 'name' => 'unit-test-sidebar-1', 'title' => 'Unit Test Sidebar 1', 'data' => ['sidebar1'] ],
                    [ 'name' => 'unit-test-sidebar-2', 'title' => 'Unit Test Sidebar 2', 'data' => ['sidebar2'] ],
                ],
                'actions' => [
                    [ 'name' => 'unit-test-action-1', 'title' => 'Unit Test Action 1', 'data' => ['action1'] ],
                    [ 'name' => 'unit-test-action-2', 'title' => 'Unit Test Action 2', 'data' => ['action2'] ],
                ],
            ]
        ];
        $this->assertEqualsCanonicalizing($expected, $actual);
    }

    public function testLanguageParse()
    {
        $actual = Builder::page('model.page-name')
            ->tab('model.unit-tab', ['tab1'])
            ->tab('model.unit-tab-2', ['tab2'])
            ->sidebar('model.unit-sidebar', ['sidebar1'])
            ->sidebar('model.unit-sidebar-2', ['sidebar2'])
            ->action('model.unit-action', ['action1'])
            ->action('model.unit-action-2', ['action2'])
            ->toArray();
        $expected = [
            'page' => [
                'name' => 'page-name',
                'title' => 'Valid translation',
            ],
            'layout' => [
                'tabs' => [
                    [ 'name' => 'unit-tab', 'title' => 'Valid translation', 'data' => ['tab1'] ],
                    [ 'name' => 'unit-tab-2', 'title' => 'Valid translation', 'data' => ['tab2'] ],
                ],
                'sidebars' => [
                    [ 'name' => 'unit-sidebar', 'title' => 'Valid translation', 'data' => ['sidebar1'] ],
                    [ 'name' => 'unit-sidebar-2', 'title' => 'Valid translation', 'data' => ['sidebar2'] ],
                ],
                'actions' => [
                    [ 'name' => 'unit-action', 'title' => 'Valid translation', 'data' => ['action1'] ],
                    [ 'name' => 'unit-action-2', 'title' => 'Valid translation', 'data' => ['action2'] ],
                ],
            ]
        ];
        $this->assertEqualsCanonicalizing($expected, $actual);
    }

    public function testCleanChildren()
    {
        $actual = Builder::page('clean children')
            ->tab('tab', [
                [
                    'name' => 'name',
                    'prop-null' => null,
                    'prop-zero' => 0,
                    'prop-empty-array' => [],
                    'prop-empty-string' => '',
                ],
                [
                    'name' => 'name2',
                    'prop-null' => null,
                    'prop-zero' => 0,
                    'prop-empty-array' => [],
                    'prop-empty-string' => '',
                ]
            ])
            ->sidebar('sidebar', [
                [
                    'name' => 'name',
                    'prop-null' => null,
                    'prop-zero' => 0,
                    'prop-empty-array' => [],
                    'prop-empty-string' => '',
                ],
                [
                    'name' => 'name2',
                    'prop-null' => null,
                    'prop-zero' => 0,
                    'prop-empty-array' => [],
                    'prop-empty-string' => '',
                ]
            ])
            ->action('action', [
                [
                    'name' => 'name',
                    'prop-null' => null,
                    'prop-zero' => 0,
                    'prop-empty-array' => [],
                    'prop-empty-string' => '',
                ],
                [
                    'name' => 'name2',
                    'prop-null' => null,
                    'prop-zero' => 0,
                    'prop-empty-array' => [],
                    'prop-empty-string' => '',
                ]
            ])
            ->toArray();
        $expected = [
            'page' => [
                'name' => 'clean children',
                'title' => '',
            ],
            'layout' => [
                'tabs' => [
                    [ 'name' => 'tab', 'title' => 'Valid translation', 'data' => [
                        [
                            'name' => 'name',
                            'prop-zero' => 0,
                        ],
                        [
                            'name' => 'name2',
                            'prop-zero' => 0,
                        ]
                    ]],
                ],
                'sidebars' => [
                    [ 'name' => 'sidebar', 'title' => 'Valid translation', 'data' => [
                        [
                            'name' => 'name',
                            'prop-zero' => 0,
                        ],
                        [
                            'name' => 'name2',
                            'prop-zero' => 0,
                        ]
                    ]],
                ],
                'actions' => [
                    [ 'name' => 'action', 'title' => 'Valid translation', 'data' => [
                        [
                            'name' => 'name',
                            'prop-zero' => 0,
                        ],
                        [
                            'name' => 'name2',
                            'prop-zero' => 0,
                        ]
                    ]],
                ],
            ]
        ];
        $this->assertEqualsCanonicalizing($expected, $actual);
    }
}

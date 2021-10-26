<?php

declare(strict_types=1);

namespace aspirantzhang\test\octopusPageBuilder;

use aspirantzhang\octopusPageBuilder\Builder;

class I18nBuilderTest extends TestCase
{
    public function testEmptyParamsShouldReturnEmpty()
    {
        $actual = Builder::i18n('')->toArray();
        $expected = [
            'page' => [
                'title' => '',
            ],
        ];
        $this->assertEqualsCanonicalizing($expected, $actual);
    }

    public function testValidParamsShouldReturnCorrectResult()
    {
        $actual = Builder::i18n('foo.bar')->layout(['en-us', 'zh-cn'], ['foo' => 'bar'])->toArray();
        $expected = [
            'page' => [
                'title' => 'Valid translation'
            ],
            'fields' => [
                [
                    'name' => 'en-us',
                    'data' => ['foo' => 'bar']
                ],
                [
                    'name' => 'zh-cn',
                    'data' => ['foo' => 'bar']
                ]
            ]
        ];
        $this->assertEqualsCanonicalizing($expected, $actual);
    }

    public function testI18nLayoutCleanChildren()
    {
        $actual = Builder::i18n('foo.bar')->layout(['en-us', 'zh-cn'], [
            'name' => 'name',
            'prop-null' => null,
            'prop-zero' => 0,
            'prop-empty-array' => [],
            'prop-empty-string' => '',
        ])->toArray();
        $expected = [
            'page' => [
                'title' => 'Valid translation'
            ],
            'fields' => [
                [
                    'name' => 'en-us',
                    'data' => [
                        'name' => 'name',
                        'prop-zero' => 0,
                    ]
                ],
                [
                    'name' => 'zh-cn',
                    'data' => [
                        'name' => 'name',
                        'prop-zero' => 0,
                    ]
                ]
            ]
        ];
        $this->assertEqualsCanonicalizing($expected, $actual);
    }
}

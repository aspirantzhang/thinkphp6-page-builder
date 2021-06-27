<?php

declare(strict_types=1);

namespace aspirantzhang\test\antdBuilder;

use aspirantzhang\TPAntdBuilder\Builder;

class I18nBuilderTest extends TestCase
{
    public function testEmptyParamsShouldReturnEmpty()
    {
        $actual = Builder::i18n('')->toArray();
        $expected = [
            'page' => [
                'title' => '',
            ],
            'layout' => []
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
}

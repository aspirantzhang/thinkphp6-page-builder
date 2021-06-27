<?php

declare(strict_types=1);

namespace aspirantzhang\test\antdBuilder;

use aspirantzhang\TPAntdBuilder\Builder;

class I18nBuilderTest extends TestCase
{
    public function testEmptyParamsShouldReturnEmpty()
    {
        $actual = Builder::i18n([], [])->toArray();
        $expected = [
            'fields' => []
        ];
        $this->assertEqualsCanonicalizing($expected, $actual);
    }

    public function testValidParamsShouldReturnCorrectResult()
    {
        $actual = Builder::i18n(['en-us', 'zh-cn'], ['foo' => 'bar'])->toArray();
        $expected = [
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

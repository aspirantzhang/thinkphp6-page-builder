<?php

declare(strict_types=1);

namespace aspirantzhang\test\antdBuilder;

use aspirantzhang\TPAntdBuilder\Builder;

class ButtonBuilderTest extends \PHPUnit\Framework\TestCase
{
    public function testEmptyParamsShouldReturnInitSchema()
    {
        $actual = Builder::button('');
        $expected = [
            'component' => 'button',
            'type' => 'primary',
            'name' => '',
            'title' => '',
            'call' => '',
            'method' => null,
            'uri' => null
        ];
        $this->assertEqualsCanonicalizing($expected, (array)$actual);
    }

    public function testValidParamsShouldReturnCorrectResult()
    {
        $actual = Builder::button('unitTest', 'Unit Test')
                            ->component('a')
                            ->type('danger')
                            ->call('unitTest')
                            ->uri('unit/test/uri')
                            ->method('delete');
        $expected = [
            'component' => 'a',
            'type' => 'danger',
            'name' => 'unitTest',
            'title' => 'Unit Test',
            'call' => 'unitTest',
            'uri' => 'unit/test/uri',
            'method' => 'delete'
        ];
        var_dump($actual);
        $this->assertEqualsCanonicalizing($expected, (array)$actual);
    }
}

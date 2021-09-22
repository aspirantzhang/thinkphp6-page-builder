<?php

declare(strict_types=1);

namespace aspirantzhang\test\octopusPageBuilder;

use aspirantzhang\octopusPageBuilder\Builder;

class ButtonBuilderTest extends TestCase
{
    public function testEmptyParamsShouldReturnInitSchema()
    {
        $actual = Builder::button('');
        $expected = [
            'component' => 'button',
            'type' => 'primary',
            'name' => '',
            'title' => 'Valid translation',
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
        $this->assertEqualsCanonicalizing($expected, (array)$actual);
    }

    public function testLanguageParser()
    {
        $actual = Builder::button('model.unit-test');
        $expected = [
            'component' => 'button',
            'type' => 'primary',
            'name' => 'unit-test',
            'title' => 'Valid translation',
            'call' => '',
            'method' => null,
            'uri' => null
        ];
        $this->assertEqualsCanonicalizing($expected, (array)$actual);
    }
}

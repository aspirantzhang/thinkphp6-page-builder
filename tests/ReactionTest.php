<?php

declare(strict_types=1);

namespace aspirantzhang\test\octopusPageBuilder;

use aspirantzhang\octopusPageBuilder\Reaction;

class ReactionTest extends TestCase
{
    public function testSetTargetVisible()
    {
        $actual = (new Reaction())->setTargetVisible([
            'value1' => ['key1', 'key2'],
            'value2' => ['key3']
        ]);
        $expected = [
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
        ];
        $this->assertEqualsCanonicalizing($actual, $expected);
    }

    public function testSetMyVisible()
    {
        $actual = (new Reaction())->setMyVisible([
            'field1' => 'value1',
            'field2' => ['value2', 'value3']
        ]);
        $expected = [
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
        ];
        $this->assertEqualsCanonicalizing($actual, $expected);
    }
}

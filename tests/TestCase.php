<?php

namespace aspirantzhang\test\antdBuilder;

use Mockery as m;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    protected function setUp(): void
    {
        $mock = m::mock('alias:think\facade\Lang');
        $mock->shouldReceive('get')->andReturn('Valid translation');
    }
    protected function tearDown(): void
    {
    }
}

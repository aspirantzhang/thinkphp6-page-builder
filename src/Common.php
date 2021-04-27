<?php

declare(strict_types=1);

namespace aspirantzhang\TPAntdBuilder;

class Common
{
    public function lang(string $name)
    {
        return \think\facade\Lang::get($name);
    }
}

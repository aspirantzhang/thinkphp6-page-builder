<?php

declare(strict_types=1);

namespace aspirantzhang\TPAntdBuilder;

/**
 * Ant Design builder
 */
class Builder
{
    public static function page(string $name, string $title = '')
    {
        return (new PageBuilder())->page($name, $title);
    }
    public static function field(string $name, string $title = '')
    {
        return (new FieldBuilder())->field($name, $title);
    }
    public static function button(string $name, string $title = '')
    {
        return (new ButtonBuilder())->button($name, $title);
    }
}

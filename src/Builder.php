<?php

declare(strict_types=1);

namespace aspirantzhang\TPAntdBuilder;

/**
 * Builder for page & form.
 */
class Builder
{
    public static function __callStatic($name, $arguments)
    {
        if ('page' === $name) {
            return call_user_func_array([new PageBuilder(), $name], $arguments);
        } elseif ('column' === $name) {
            return call_user_func_array([new ColumnBuilder(), $name], $arguments);
        } else {
            return call_user_func_array([new components\Button(), $name], $arguments);
        }
    }
}

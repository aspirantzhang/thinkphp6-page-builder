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
        switch ($name) {
            case 'page':
            case 'params':
                return call_user_func_array([new PageBuilder(), $name], $arguments);
            case 'field':
                return call_user_func_array([new FieldBuilder(), $name], $arguments);
            case 'actions':
                return call_user_func_array([new ActionsBuilder(), $name], $arguments);
            default:
                return call_user_func_array([new components\Button(), $name], $arguments);
                break;
        }
    }
}

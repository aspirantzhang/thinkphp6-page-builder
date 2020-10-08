<?php

declare(strict_types=1);

namespace aspirantzhang\TPAntdBuilder;

/**
 * Builder for page & form.
 */
class Builder
{
    public static function __callStatic($name, $params)
    {
        switch ($name) {
            case 'page':
            case 'params':
                return call_user_func_array([new PageBuilder(), $name], $params);
            case 'field':
                return call_user_func_array([new FieldBuilder(), $name], $params);
            case 'actions':
                return call_user_func_array([new ActionsBuilder(), $name], $params);
            default:
                return call_user_func_array([new components\Button(), $name], $params);
                break;
        }
    }
}

<?php

declare(strict_types=1);

namespace aspirantzhang\TPAntdBuilder\components;

class Button
{
    public $component;
    public $text;
    public $type;
    public $action;

    public function __construct()
    {
        $this->component = 'button';
        $this->type = 'primary';
        $this->action = '';
    }

    public function button($value, $id = null)
    {
        $this->text = $value;
        if ($id) {
            $this->id = $id;
        }

        return $this;
    }

    public function type(string $value)
    {
        $this->type = $value;

        return $this;
    }

    public function action(string $value)
    {
        $this->action = $value;

        return $this;
    }

    public function uri(string $value)
    {
        $this->uri = $value;

        return $this;
    }

    public function method(string $value)
    {
        $this->method = $value;

        return $this;
    }
}

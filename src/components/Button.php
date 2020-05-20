<?php

declare(strict_types=1);

namespace aspirantzhang\TPAntdBuilder\components;

class Button
{
    public $component;
    public $text;
    public $type;
    public $onClick;
    public $action;

    public function __construct()
    {
        $this->component = 'button';
        $this->type = 'primary';
        $this->onClick = '';
        $this->action = '';
    }

    public function button($value)
    {
        $this->text = $value;

        return $this;
    }

    public function type(string $value)
    {
        $this->type = $value;

        return $this;
    }

    public function onClick(string $value)
    {
        $this->onClick = $value;

        return $this;
    }

    public function action(string $value)
    {
        $this->action = $value;

        return $this;
    }
}

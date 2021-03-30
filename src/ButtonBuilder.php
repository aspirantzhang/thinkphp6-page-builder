<?php

declare(strict_types=1);

namespace aspirantzhang\TPAntdBuilder;

class ButtonBuilder
{
    protected $component = "button";
    protected $type = "primary";
    protected $name;
    protected $title;
    protected $call = '';

    public function button(string $name, string $title = '')
    {
        $this->name = $name;
        $this->title = $title ?: $name;

        return $this;
    }

    public function component(string $value)
    {
        $this->component = $value;

        return $this;
    }
    
    public function type(string $value)
    {
        $this->type = $value;

        return $this;
    }

    public function call(string $value)
    {
        $this->call = $value;

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

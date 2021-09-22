<?php

declare(strict_types=1);

namespace aspirantzhang\octopusPageBuilder;

class ButtonBuilder extends Common
{
    public $component = "button";
    public $type = "primary";
    public $name;
    public $title;
    public $call = null;
    public $method = null;
    public $uri = null;

    public function button(string $name, string $title = '')
    {
        $this->name = $name;
        $this->title = $title;

        if ($title === '') {
            $this->title = __($name);
        }

        if (strpos($name, '.')) {
            $nameId = explode('.', $name, 2);
            $this->name = $nameId[1];
            if ($title === '') {
                $this->title = __($name);
            }
        }

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

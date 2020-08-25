<?php

declare(strict_types=1);

namespace aspirantzhang\TPAntdBuilder;

class FieldBuilder
{
    public $title;
    public $dataIndex;
    public $key;
    public $type;

    public function field(string $name, string $title)
    {
        $this->title = $title;
        $this->dataIndex = $this->key = $name;

        return $this;
    }

    public function type(string $type = 'text')
    {
        $this->type = $type;

        return $this;
    }

    public function sorter(bool $value)
    {
        $this->sorter = $value;

        return $this;
    }

    public function data(array $data)
    {
        $this->data = $data;

        return $this;
    }

    public function hideInColumn(bool $value)
    {
        $this->hideInColumn = $value;
        return $this;
    }

    public function disabled(bool $value)
    {
        $this->disabled = $value;
        return $this;
    }
}

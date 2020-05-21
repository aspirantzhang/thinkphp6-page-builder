<?php

declare(strict_types=1);

namespace aspirantzhang\TPAntdBuilder;

class ColumnBuilder
{
    public $title;
    public $dataIndex;
    public $key;
    public $type;

    public function column(string $name, string $title)
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

    public function action(array $actions)
    {
        $this->action = $actions;

        return $this;
    }

    public function values(array $values)
    {
        $this->values = $values;

        return $this;
    }
}

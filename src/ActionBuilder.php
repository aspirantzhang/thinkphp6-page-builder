<?php

declare(strict_types=1);

namespace aspirantzhang\TPAntdBuilder;

class ActionBuilder
{
    public $dataIndex;
    public $key;
    public $type;

    public function action(array $actions)
    {
        $this->dataIndex = $this->key = $this->type = 'action';
        $this->actions = $actions;

        return $this;
    }

    public function title(string $title)
    {
        $this->title = $title;

        return $this;
    }
}

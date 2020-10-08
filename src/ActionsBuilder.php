<?php

declare(strict_types=1);

namespace aspirantzhang\TPAntdBuilder;

class ActionsBuilder
{
    public $dataIndex;
    public $key;
    public $type;

    public function actions(array $actions)
    {
        $this->dataIndex = $this->key = $this->type = 'actions';
        $this->actions = $actions;

        return $this;
    }

    public function title(string $title)
    {
        $this->title = $title;

        return $this;
    }
}

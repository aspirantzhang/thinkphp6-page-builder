<?php

declare(strict_types=1);

namespace aspirantzhang\TPAntdBuilder;

class PageBuilder
{
    public $page;
    public $layout;

    public function page(string $title)
    {
        $this->page['title'] = $title;

        return $this;
    }

    public function type(string $type)
    {
        $this->page['type'] = $type;

        return $this;
    }

    public function searchBar(bool $value = false)
    {
        $this->page['searchBar'] = $value;

        return $this;
    }

    public function tableToolBar(array $tableToolBar)
    {
        $this->layout['tableToolBar'] = $tableToolBar;

        return $this;
    }

    public function batchToolBar(array $batchToolBar)
    {
        $this->layout['batchToolBar'] = $batchToolBar;

        return $this;
    }

    public function tableColumn(array $tableColumn)
    {
        $this->layout['tableColumn'] = $tableColumn;

        return $this;
    }

    // Layout

    public function tab(array $data, string $name = 'basic', string $title = 'Basic')
    {
        $tab = [
            'name' => $name,
            'title' => $title,
            'data' => $data,
        ];
        $this->layout['tabs'][] = $tab;

        return $this;
    }

    public function sidebar(array $data, string $name = 'sidebar', string $title = 'Sidebar')
    {
        $sidebar = [
            'name' => $name,
            'title' => $title,
            'data' => $data,
        ];
        $this->layout['sidebars'][] = $sidebar;

        return $this;
    }

    public function action(array $data, string $name = 'actions', string $title = 'Actions')
    {
        $action = [
            'name' => $name,
            'title' => $title,
            'data' => $data,
        ];
        $this->layout['actions'][] = $action;

        return $this;
    }

    public function actions(array $data)
    {
        $this->layout['actions'] = $data;
        
        return $this;
    }

    public function toArray(): array
    {
        return (array) $this;
    }
}

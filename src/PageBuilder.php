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

    public function main(array $data, string $name = 'main', string $title = 'Main')
    {
        $this->layout['main']['name'] = $name;
        $this->layout['main']['title'] = $title;
        $this->layout['main']['data'] = $data;

        return $this;
    }

    public function sidebar(array $data, string $name = 'sidebar', string $title = 'Sidebar')
    {
        $this->layout['sidebar']['name'] = $name;
        $this->layout['sidebar']['title'] = $title;
        $this->layout['sidebar']['data'] = $data;

        return $this;
    }

    public function actions(array $data, string $name = 'actions', string $title = 'Actions')
    {
        $this->layout['actions']['name'] = $name;
        $this->layout['actions']['title'] = $title;
        $this->layout['actions']['data'] = $data;

        return $this;
    }

    public function toArray(): array
    {
        return (array) $this;
    }
}

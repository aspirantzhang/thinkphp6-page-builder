<?php

declare(strict_types=1);

namespace aspirantzhang\TPAntdBuilder;

class PageBuilder extends Common
{
    public $page = [
        'name' => '',
        'title' => '',
        'type' => '',
    ];
    public $layout = [];

    public function page(string $name, string $title = '')
    {
        $this->page['name'] = $name;
        $this->page['title'] = $title;

        if (strpos($name, '.')) {
            $nameId = explode('.', $name, 2);
            $this->page['name'] = $nameId[1];
            if ($title === '') {
                $this->page['title'] = $this->lang($name);
            }
        }

        return $this;
    }

    public function type(string $type)
    {
        $this->page['type'] = $type;

        return $this;
    }

    // BasicList
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

    // Page or Modal
    public function tab(string $name = 'basic', string $title = '', array $data = [])
    {
        $tab = [
            'name' => $name,
            'title' => $title,
            'data' => $data,
        ];
        $this->layout['tabs'][] = $tab;

        return $this;
    }

    public function sidebar(string $name = 'sidebar', string $title = '', array $data = [])
    {
        $sidebar = [
            'name' => $name,
            'title' => $title,
            'data' => $data,
        ];
        $this->layout['sidebars'][] = $sidebar;

        return $this;
    }

    public function action(string $name = 'actions', string $title = '', array $data = [])
    {
        $action = [
            'name' => $name,
            'title' => $title,
            'data' => $data,
        ];
        $this->layout['actions'][] = $action;

        return $this;
    }

    public function toArray(): array
    {
        return (array) $this;
    }
}

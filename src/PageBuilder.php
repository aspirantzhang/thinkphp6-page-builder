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

        // Init search bar expand
        if ($value) {
            $this->page['searchExpand'] = false;
        }

        return $this;
    }

    public function params($params)
    {
        if (isset($params['searchExpand']) && 'true' === $params['searchExpand']) {
            $this->page['searchExpand'] = true;
        }

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

    public function toArray(): array
    {
        return (array) $this;
    }
}

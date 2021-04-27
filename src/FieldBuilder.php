<?php

declare(strict_types=1);

namespace aspirantzhang\TPAntdBuilder;

class FieldBuilder extends Common
{
    public $name;
    public $title;
    public $type = 'text';
    public $data = [];
    public $hideInColumn = null;
    public $sorter = null;
    public $editDisabled = null;
    public $mode = null;

    public function field(string $name, string $title = '')
    {
        $this->name = $name;
        $this->title = $title;

        if ($title === '') {
            $this->title = $this->lang($name);
        }

        if (strpos($name, '.')) {
            $nameId = explode('.', $name, 2);
            $this->name = $nameId[1];
            if ($title === '') {
                $this->title = $this->lang($name);
            }
        }

        if ($name === 'actions') {
            $this->type = 'actions';
        }

        return $this;
    }

    public function type(string $type)
    {
        $this->type = $type;

        switch ($type) {
            case 'select':
                $this->mode = 'multiple';
                break;
            case 'trash':
                $this->type = 'select';
                $this->data = [
                    [
                        'title' => $this->lang('onlyTrashed'),
                        'value' => 'onlyTrashed'
                    ],
                    [
                        'title' => $this->lang('withTrashed'),
                        'value' => 'withTrashed'
                    ],
                    [
                        'title' => $this->lang('withoutTrashed'),
                        'value' => 'withoutTrashed'
                    ],
                ];
                $this->mode = '';
                $this->hideInColumn = true;
                break;
            case 'switch':
                $this->data = [
                    [
                        'title' => $this->lang('enabled'),
                        'value' => 1,
                    ],
                    [
                        'title' => $this->lang('disabled'),
                        'value' => 0,
                    ],
                ];
                break;
            
            default:
                # code...
                break;
        }


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

    public function editDisabled(bool $value)
    {
        $this->editDisabled = $value;

        return $this;
    }

    public function mode(string $value)
    {
        $this->mode = $value;

        return $this;
    }
}

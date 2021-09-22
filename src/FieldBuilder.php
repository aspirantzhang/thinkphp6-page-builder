<?php

declare(strict_types=1);

namespace aspirantzhang\octopusPageBuilder;

use think\facade\Config;

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
            $this->title = __($name);
        }

        if (strpos($name, '.')) {
            $nameId = explode('.', $name, 2);
            $this->name = $nameId[1];
            if ($title === '') {
                $this->title = __($name);
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
                        'title' => __('onlyTrashed'),
                        'value' => 'onlyTrashed'
                    ],
                    [
                        'title' => __('withTrashed'),
                        'value' => 'withTrashed'
                    ],
                    [
                        'title' => __('withoutTrashed'),
                        'value' => 'withoutTrashed'
                    ],
                ];
                $this->mode = '';
                $this->hideInColumn = true;
                break;
            case 'switch':
                $this->data = [
                    [
                        'title' => __('enabled'),
                        'value' => 1,
                    ],
                    [
                        'title' => __('disabled'),
                        'value' => 0,
                    ],
                ];
                break;
            case 'i18n':
                $this->data = Config::get('lang.allow_lang_list');
                break;

            default:
                # code...
                break;
        }


        return $this;
    }

    public function listSorter(bool $value)
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

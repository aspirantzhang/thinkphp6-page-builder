<?php
declare (strict_types = 1);

namespace aspirantzhang\TPAntdBuilder;

use think\App;
use Nette\Utils\Arrays;

Class Builder
{
    protected $app;
    protected $result;
    protected $containerName;
    protected $component;
    protected $key;
    protected $actionKey;

    public function __construct()
    {
        $app = New APP;
        $this->app     = $app;
        $this->result = [];
        $this->containerName = '';
        $this->tableName = '';
        $this->component = '';
        $this->key = 0;
        $this->actionKey = 0;
    }

    public function page($name, $title)
    {
        $this->containerName = __FUNCTION__;
        $this->result[$this->containerName] = [
            'name'  =>  $name,
            'title' =>  $title,
        ];
        return $this;
    }

    public function pageType($str)
    {
        $this->result[$this->containerName][__FUNCTION__] = $str;
        return $this;
    }

    public function sidebar($name, $title)
    {
        $this->result['page']['sidebar'][] = $name;
        $this->result[$name] = ['title' => $title];
        return $this;
    }

    public function table($name, $title)
    {
        $this->containerName = __FUNCTION__;
        $this->result[$this->containerName]['name'] = $name;
        $this->result[$this->containerName]['title'] = $title;
        return $this;
    }
    public function titleBar()
    {
        $this->containerName = __FUNCTION__;
        return $this;
    }
    public function toolBar()
    {
        $this->containerName = __FUNCTION__;
        return $this;
    }

    public function searchBar()
    {
        $this->containerName = __FUNCTION__;
        return $this;
    }

    public function advancedSearch()
    {
        $this->containerName = __FUNCTION__;
        return $this;
    }
    public function bottomBar()
    {
        $this->containerName = __FUNCTION__;
        return $this;
    }

    public function addText($name, $title)
    {
        $this->result[$this->containerName][] = [
            'component'   =>  'input',
            'name'  =>  $name,
            'title' =>  $title,
        ];
        $this->key = array_key_last($this->result[$this->containerName]);
        return $this;
    }

    public function addButton($name, $title)
    {
        $this->result[$this->containerName][] = [
            'component'   =>  'button',
            'name'  =>  $name,
            'title' =>  $title,
        ];
        $this->key = array_key_last($this->result[$this->containerName]);
        return $this;
    }

    public function addSelect($name, $title)
    {
        $this->result[$this->containerName][] = [
            'component'   =>  'select',
            'name'  =>  $name,
            'title' =>  $title,
        ];
        $this->key = array_key_last($this->result[$this->containerName]);
        return $this;
    }


    public function addDatePicker($name, $title)
    {
        $this->result[$this->containerName][] = [
            'component'   =>  'rangePicker',
            'name'  =>  $name,
            'title' =>  $title,
        ];
        $this->key = array_key_last($this->result[$this->containerName]);
        return $this;
    }

    public function toTable($name)
    {
        $this->containerName = 'table';
        return $this;
    }

    public function addColumn($name, $title)
    {
        $this->result[$this->containerName]['column'][] = [
            'dataIndex' =>  $name,
            'title'     =>  $title,
        ];
        $this->key = array_key_last($this->result[$this->containerName]['column']);
        return $this;
    }
    public function actionButton($name, $title, $append = [])
    {
        $this->result[$this->containerName]['column'][$this->key]['action'][] = [
            'dataIndex' =>  $name,
            'title'     =>  $title,
        ];
        foreach ($append as $key => $value) {
            $this->result[$this->containerName]['column'][$this->key]['action'][$this->actionKey][$key] = $value;
        }
        $this->actionKey = array_key_last($this->result[$this->containerName]['column'][$this->key]['action']);
        $this->actionKey++;
        return $this;
    }


    public function link($uri, $target="_self")
    {
        $this->result[$this->containerName]['column'][$this->key]['a']['href'] = $uri;
        $this->result[$this->containerName]['column'][$this->key]['a']['target'] = $target;
        return $this;
    }

    public function format($str)
    {
        $this->result[$this->containerName][$this->key][__FUNCTION__] = $str;
        return $this;
    }

    public function placeholder($str)
    {
        $this->result[$this->containerName][$this->key][__FUNCTION__] = $str;
        return $this;
    }

    public function type($str)
    {
        $this->result[$this->containerName][$this->key][__FUNCTION__] = $str;
        return $this;
    }

    public function option($arr)
    {
        $optionArr = [];
        foreach ($arr as $key => $value) {
            $optionArr[] = [
                'name'  =>  $key,
                'value' =>  $value,
            ];
        }
        $this->result[$this->containerName][$this->key][__FUNCTION__] = $arr;
        return $this;
    }

    public function append($data)
    {
        foreach ($data as $key => $value) {
            $this->result[$this->containerName][$this->key][$key] = $value;
        }
        return $this;
    }

    public function build()
    {
        return $this->result;
    }



}
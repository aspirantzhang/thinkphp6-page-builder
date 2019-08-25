<?php
declare (strict_types = 1);

namespace aspirantzhang\TPAntdBuilder;

Class Builder
{
    protected $result;
    protected $containerName;
    protected $component;
    protected $key;
    protected $actionKey;

    protected $globalContainers = ['titleBar', 'toolBar', 'searchBar', 'advancedSearch', 'bottomBar'];
    protected $generalElements = ['text', 'button', 'select', 'radio', 'checkbox', 'switch', 'datepicker'];


    /**
     *  toContainer > addElements > Attributes
     */

    public function __construct()
    {
        $this->result = [];
        $this->containerName = '';
        $this->tableName = '';
        $this->component = '';
        $this->key = 0;
        $this->actionKey = 0;
    }


    public function __call($name, $arguments)
    {

        if ($this->isToContainer($name)) {

            $this->containerName = strtolower(substr($name, 2));
            return $this;

        } else if ($this->isGlobalContainer($name)) {

            $this->containerName = $name;
            return $this;

        } else if ($this->isAddElement($name)){

            $name = strtolower(substr($name, 3));

            if ($this->isGeneralElement($name)) {


                switch ($name) {
                    case 'text':
                        $componentName = 'input';
                        break;
                    case 'button':
                        $componentName = 'button';
                        break;
                    case 'select':
                        $componentName = 'select';
                        break;
                    case 'radio':
                        $componentName = 'radio';
                        break;
                    case 'checkbox':
                        $componentName = 'checkbox';
                        break;
                    case 'switch':
                        $componentName = 'switch';
                        break;
                    case 'datepicker':
                        $componentName = 'rangePicker';
                        break;

                    default:
                        # code...
                        break;
                }
                $this->result[$this->containerName][] = [
                    'component' =>  $componentName,
                    'name'      =>  $arguments[0],
                    'title'     =>  $arguments[1],
                ];
                $this->key = array_key_last($this->result[$this->containerName]);

                return $this;

            } else {

                return 'no exists element';

            }


        } else {
            echo 'no';
        }
    }


    protected function isToContainer($name)
    {
        return (strpos($name, 'to') === 0) && preg_match('/^[A-Z]+$/', substr($name, 2, 1));
    }

    protected function isGlobalContainer($name)
    {
        return in_array($name, $this->globalContainers);
    }

    protected function isAddElement($name)
    {
        return (strpos($name, 'add') === 0) && preg_match('/^[A-Z]+$/', substr($name, 3, 1));
    }

    protected function isGeneralElement($name)
    {
        return in_array($name, $this->generalElements);
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

    public function sidebar($name)
    {
        $this->result['page']['sidebar'][] = $name;
        return $this;
    }

    public function table($name, $title)
    {
        $this->containerName = __FUNCTION__;
        $this->result[$this->containerName]['name'] = $name;
        $this->result[$this->containerName]['title'] = $title;
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

    public function option($arr, $default=0)
    {
        $optionArr = [];
        $num = 0;
        foreach ($arr as $key => $value) {
            $buildArr = [
                'name'  =>  $value,
                'value' =>  $key,
            ];
            if ($num == $default) {
                $buildArr['default'] = true;
            }
            $optionArr[] = $buildArr;
            $num++;
        }
        $this->result[$this->containerName][$this->key][__FUNCTION__] = $optionArr;
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
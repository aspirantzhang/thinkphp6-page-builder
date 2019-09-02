<?php
declare (strict_types = 1);

namespace aspirantzhang\TPAntdBuilder;

Class Builder
{
    protected $realData;
    protected $result;
    protected $containerName;
    protected $tableName;
    protected $columnName;
    protected $component;
    protected $key;
    protected $actionKey;
    protected $pageType;

    protected $commonContainers = ['titleBar', 'toolBar', 'searchBar', 'advancedSearch', 'bottomBar'];
    protected $commonElements = ['text', 'button', 'select', 'radio', 'checkbox', 'switch', 'datepicker', 'textarea', 'tree'];


    /**
     *  toContainer > addElements > Attributes
     */

    public function __construct($realData=[], $pageType='create')
    {
        $this->realData = $realData;
        $this->pageType = $pageType;
        $this->result = [];
        $this->containerName = '';
        $this->tableName = '';
        $this->columnName = '';
        $this->component = '';
        $this->key = 0;
        $this->actionKey = 0;
    }


    public function __call($name, $arguments)
    {

        if ($this->isToContainer($name)) {

            $this->containerName = strtolower(substr($name, 2));
            return $this;

        } else if ($this->isCommonContainer($name)) {

            $this->containerName = $name;
            return $this;

        } else if ($this->isAddElement($name)){

            $name = strtolower(substr($name, 3));

            if ($this->isCommonElement($name)) {

                $writeValue = true;

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
                    case 'textarea':
                        $componentName = 'textarea';
                        break;
                    case 'tree':
                        $componentName = 'tree';
                        $writeValue = false;
                        break;

                    default:
                        # code...
                        break;
                }

                $temp = [
                    'component' =>  $componentName,
                    'name'      =>  $arguments[0],
                    'title'     =>  $arguments[1],
                ];

                if ($this->haveData($arguments[0]) !== false) {

                    if ($writeValue == true) {
                        $temp['value']  =  $this->haveData($arguments[0]);
                    }

                    // Tree Component Default Value
                    if ($componentName == 'tree') {
                        $defaultKeys = [];

                        if (is_array($this->haveData($arguments[0]))) {
                            foreach ($this->haveData($arguments[0]) as $key => $value) {
                                $defaultKeys[] = (string)$value['id'];
                            }
                        } else if (is_string($this->haveData($arguments[0])) && (strpos($this->haveData($arguments[0]), ',') !== false)) {
                            $defaultKeys = explode(',', $this->haveData($arguments[0]));
                        } else {
                            $defaultKeys = $this->haveData($arguments[0]);
                        }

                        $temp['defaultKeys']  =  $defaultKeys;
                    }

                }

                $this->result[$this->containerName][] = $temp;
                $this->key = array_key_last($this->result[$this->containerName]);

                return $this;

            } else {

                return 'not common element';

            }


        } else {
            echo 'unknown element';
        }
    }

    protected function haveData($key)
    {
        if (isset($this->realData[$key]) && $this->realData[$key] !== '') {
            return $this->realData[$key];
        } else {
            return false;
        }
    }

    protected function isToContainer($name)
    {
        return (strpos($name, 'to') === 0) && preg_match('/^[A-Z]+$/', substr($name, 2, 1));
    }

    protected function isCommonContainer($name)
    {
        return in_array($name, $this->commonContainers);
    }

    protected function isAddElement($name)
    {
        return (strpos($name, 'add') === 0) && preg_match('/^[A-Z]+$/', substr($name, 3, 1));
    }

    protected function isCommonElement($name)
    {
        return in_array($name, $this->commonElements);
    }


    public function pageType($typeName)
    {
        $this->pageType = $typeName;
        $this->result['page']['type'] = $typeName;
        return $this;
    }
    public function pageTitle($name, $titleArr)
    {
        $this->containerName = __FUNCTION__;
        $pageName = $name.'-'.$this->pageType;
        $pageTitle = $titleArr[$this->pageType];
        $this->result['page']['name'] = $pageName;
        $this->result['page']['title'] = $pageTitle;
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

    public function columnLink($uri, $target="_self")
    {
        $this->result[$this->containerName]['column'][$this->key]['a']['href'] = $uri;
        $this->result[$this->containerName]['column'][$this->key]['a']['target'] = $target;
        return $this;
    }
    public function columTag($arr)
    {
        foreach ($arr as $key => $value) {
            $this->result[$this->containerName]['column'][$this->key]['tag'][$key] = $value;
        }
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
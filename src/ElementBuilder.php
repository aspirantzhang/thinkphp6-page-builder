<?php

declare(strict_types=1);

namespace aspirantzhang\TPAntdBuilder;

class ElementBuilder extends Common
{
    public function singleChoice($trueValueName = 'enabled', $falseValueName = 'disabled')
    {
        return [
            [
                'title' => $this->lang('enabled'),
                'value' => 1,
            ],
            [
                'title' => $this->lang('disabled'),
                'value' => 0,
            ],
        ];
    }
}

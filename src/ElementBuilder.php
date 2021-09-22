<?php

declare(strict_types=1);

namespace aspirantzhang\octopusPageBuilder;

class ElementBuilder extends Common
{
    public function singleChoice($trueValueName = 'enabled', $falseValueName = 'disabled')
    {
        return [
            [
                'title' => __('enabled'),
                'value' => 1,
            ],
            [
                'title' => __('disabled'),
                'value' => 0,
            ],
        ];
    }
}

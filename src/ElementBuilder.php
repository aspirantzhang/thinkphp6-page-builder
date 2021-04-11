<?php

declare(strict_types=1);

namespace aspirantzhang\TPAntdBuilder;

class ElementBuilder
{
    public function singleChoice($trueValueTitle = 'Enabled', $falseValueTitle = 'Disabled')
    {
        return [
            [
                'title' => $trueValueTitle,
                'value' => 1,
            ],
            [
                'title' => $falseValueTitle,
                'value' => 0,
            ],
        ];
    }
}

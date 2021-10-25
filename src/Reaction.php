<?php

declare(strict_types=1);

namespace aspirantzhang\octopusPageBuilder;

class Reaction
{
    // https://github.com/alibaba/formily/blob/5a853146a8504a2ff79671dc34034ee64211dc16/docs/guide/index.zh-CN.md

    public function setTargetVisible($data)
    {
        $conditions = [];
        foreach ($data as $selfValue => $target) {
            $conditions[] = [
                'target' => $target,
                'when' => $selfValue,
            ];
        }
        return [
            'type' => 'active',
            'property' => 'visible',
            'conditions' => $conditions
        ];
    }

    public function setMyVisible($data)
    {
        $conditions = [];
        foreach ($data as $dependency => $value) {
            $conditions[] = [
                'dependency' => $dependency,
                'when' => $value,
            ];
        }
        return [
            'type' => 'passive',
            'property' => 'visible',
            'conditions' => $conditions
        ];
    }
}

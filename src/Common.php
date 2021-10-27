<?php

declare(strict_types=1);

namespace aspirantzhang\octopusPageBuilder;

class Common
{
    public function toArray()
    {
        return $this->cleanArrayElement((array)$this);
    }

    public function cleanArrayElement(array|object $target)
    {
        return array_filter((array)$target, function ($value) {
            return !empty($value) || $value === 0 || $value === '0';
        });
    }

    public function cleanChildrenEmptyValues(array $data): array
    {
        return array_map(function ($children) {
            if (is_array($children) || gettype($children) === 'object') {
                return $this->cleanArrayElement($children);
            }
            return $children;
        }, $data);
    }
}

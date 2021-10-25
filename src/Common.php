<?php

declare(strict_types=1);

namespace aspirantzhang\octopusPageBuilder;

class Common
{
    public function toArray(array $target = null)
    {
        if ($target === null) {
            $target = (array)$this;
        }
        return array_values(array_filter($target, function ($value) {
            return !empty($value) || $value === 0 || $value === '0';
        }));
    }

    public function cleanChildren(array $data): array
    {
        return array_map(function ($children) {
            if (is_array($children)) {
                return $this->toArray($children);
            }
            return $children;
        }, $data);
    }
}

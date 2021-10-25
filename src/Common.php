<?php

declare(strict_types=1);

namespace aspirantzhang\octopusPageBuilder;

class Common
{
    public function toArray()
    {
        return array_values(array_filter((array)$this, function ($value) {
            // @phpstan-ignore-next-line
            return !empty($value) || $value === 0 || $value === '0';
        }));
    }
}

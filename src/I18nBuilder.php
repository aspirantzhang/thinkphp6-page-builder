<?php

declare(strict_types=1);

namespace aspirantzhang\TPAntdBuilder;

class I18nBuilder extends Common
{
    public $fields = [];

    public function i18n(array $langCodes, array $fields)
    {
        $result = [];
        foreach ($langCodes as $langCode) {
            $result[] = [
                'name' => $langCode,
                'data' => $fields,
            ];
        }
        $this->fields = $result;

        return $this;
    }

    public function toArray(): array
    {
        return (array) $this;
    }
}

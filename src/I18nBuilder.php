<?php

declare(strict_types=1);

namespace aspirantzhang\octopusPageBuilder;

class I18nBuilder extends Common
{
    public $page = [];
    public $layout = [];

    public function i18n(string $title = '')
    {
        $this->page['title'] = $title;
        if (strpos($title, '.')) {
            $this->page['title'] = __($title);
        }

        return $this;
    }

    public function layout(array $langCodes, array $fields)
    {
        $result = [];
        foreach ($langCodes as $langCode) {
            $result[] = [
                'name' => $langCode,
                'data' => $fields,
            ];
        }
        $this->layout = $result;

        return $this;
    }
}

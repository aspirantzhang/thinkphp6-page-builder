<?php

declare(strict_types=1);

namespace aspirantzhang\TPAntdBuilder;

use think\Paginator;

/**
 * AntDesignPro Pagination.
 */
class AntdPaginationProvider extends Paginator
{
    public function toArray(): array
    {
        try {
            $total = $this->total();
        } catch (DomainException $e) {
            $total = null;
        }

        return [
            'dataSource' => $this->items->toArray(),
            'pagination' => [
                'total' => $total,
                'per_page' => $this->listRows(),
                'page' => $this->currentPage(),
            ],
        ];
    }

    public function render()
    {
    }
}

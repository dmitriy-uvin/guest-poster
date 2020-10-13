<?php

declare(strict_types=1);

namespace App\Action;

final class ByIdsRequest
{
    private array $ids;

    public function __construct(array $ids)
    {
        $this->ids = $ids;
    }

    public function getIds(): array
    {
        return $this->ids;
    }
}

<?php

namespace App\Action\Filter;

final class UpdateFilterByIdRequest
{
    private int $filterId;
    private array $filterItems;

    public function __construct(int $filterId, array $filterItems)
    {
        $this->filterId = $filterId;
        $this->filterItems = $filterItems;
    }

    public function getFilterId(): int
    {
        return $this->filterId;
    }

    public function getFilterItems(): array
    {
        return $this->filterItems;
    }
}

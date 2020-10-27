<?php

declare(strict_types=1);

namespace App\Action\Filter;

final class SaveUserFilterRequest
{
    private string $name;
    private array $filterItems;

    public function __construct(string $name, array $filterItems)
    {
        $this->name = $name;
        $this->filterItems = $filterItems;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getFilterItems(): array
    {
        return $this->filterItems;
    }
}

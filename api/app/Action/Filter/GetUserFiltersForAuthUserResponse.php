<?php

namespace App\Action\Filter;

use Illuminate\Support\Collection;

final class GetUserFiltersForAuthUserResponse
{
    private Collection $userFilters;

    public function __construct(Collection $userFilters)
    {
        $this->userFilters = $userFilters;
    }

    public function getUserFilters(): Collection
    {
        return $this->userFilters;
    }
}

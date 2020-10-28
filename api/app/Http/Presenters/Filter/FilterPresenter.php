<?php

namespace App\Http\Presenters\Filter;

use App\Http\Presenters\Filter\FilterItem\FilterItemPresenter;
use App\Models\Filter;
use Illuminate\Support\Collection;

final class FilterPresenter
{
    private FilterItemPresenter $filterItemPresenter;

    public function __construct(FilterItemPresenter $filterItemPresenter)
    {
        $this->filterItemPresenter = $filterItemPresenter;
    }

    public function present(Filter $filter)
    {
        return [
            'id' => $filter->id,
            'name' => $filter->name,
            'filter_items' => $filter->filterItems->map(fn($filterItem) => $this->filterItemPresenter->present($filterItem))
        ];
    }

    public function presentCollection(Collection $filters)
    {
        return $filters->map(fn($filter) => $this->present($filter))->toArray();
    }
}

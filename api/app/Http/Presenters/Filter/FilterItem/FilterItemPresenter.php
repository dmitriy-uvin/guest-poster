<?php

namespace App\Http\Presenters\Filter\FilterItem;

use App\Models\FilterItem;

final class FilterItemPresenter
{
    public function present(FilterItem $filterItem)
    {
        return [
            'id' => $filterItem->id,
            'name' => $filterItem->name,
            'column_name' => $filterItem->column_name,
            'property' => $filterItem->property,
            'from' => $filterItem->from,
            'to' => $filterItem->to,
            'value' => $filterItem->value,
            'items' => $filterItem->items,
        ];
    }
}

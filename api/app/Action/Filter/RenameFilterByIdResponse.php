<?php


namespace App\Action\Filter;

use App\Models\Filter;

final class RenameFilterByIdResponse
{
    private Filter $filter;

    public function __construct(Filter $filter)
    {
        $this->filter = $filter;
    }

    public function getFilter(): Filter
    {
        return $this->filter;
    }
}

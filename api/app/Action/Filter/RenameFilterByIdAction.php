<?php

namespace App\Action\Filter;

use App\Exceptions\Filter\FilterNotFoundException;
use App\Models\Filter;

final class RenameFilterByIdAction
{
    public function execute(RenameFilterByIdRequest $request)
    {
        $filter = Filter::find($request->getId());

        if (is_null($filter)) {
            throw new FilterNotFoundException();
        }

        $filter->name = $request->getName();
        $filter->save();

        return new RenameFilterByIdResponse($filter);
    }
}

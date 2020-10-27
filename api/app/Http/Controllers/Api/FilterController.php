<?php

namespace App\Http\Controllers\Api;

use App\Action\Filter\SaveUserFilterAction;
use App\Action\Filter\SaveUserFilterRequest;
use App\Http\Requests\Filter\SaveUserFilterHttpRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FilterController extends ApiController
{
    private SaveUserFilterAction $saveUserFilterAction;

    public function __construct(SaveUserFilterAction $saveUserFilterAction)
    {
        $this->saveUserFilterAction = $saveUserFilterAction;
    }

    public function getFiltersForAuthUser(): JsonResponse
    {

    }

    public function saveFilter(SaveUserFilterHttpRequest $request)
    {
//        return $request;
        $this->saveUserFilterAction->execute(
            new SaveUserFilterRequest(
                $request->name,
                $request->filter_items,
            )
        );
        return $this->emptyResponse();
    }

    public function deleteFilterById(string $id): JsonResponse
    {

    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Action\ByIdRequest;
use App\Action\Filter\DeleteFilterByIdAction;
use App\Action\Filter\GetUserFiltersForAuthUserAction;
use App\Action\Filter\RenameFilterByIdAction;
use App\Action\Filter\RenameFilterByIdRequest;
use App\Action\Filter\SaveUserFilterAction;
use App\Action\Filter\SaveUserFilterRequest;
use App\Action\Filter\UpdateFilterByIdAction;
use App\Action\Filter\UpdateFilterByIdRequest;
use App\Http\Presenters\Filter\FilterPresenter;
use App\Http\Requests\Filter\RenameFilterByIdHttpRequest;
use App\Http\Requests\Filter\SaveUserFilterHttpRequest;
use App\Http\Requests\Filter\UpdateFilterByIdHttpRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class FilterController extends ApiController
{
    private FilterPresenter $filterPresenter;
    private SaveUserFilterAction $saveUserFilterAction;
    private RenameFilterByIdAction $renameFilterByIdAction;
    private GetUserFiltersForAuthUserAction $getUserFilterForAuthUserAction;
    private DeleteFilterByIdAction $deleteFilterByIdAction;
    private UpdateFilterByIdAction $updateFilterByIdAction;

    public function __construct(
        SaveUserFilterAction $saveUserFilterAction,
        RenameFilterByIdAction $renameFilterByIdAction,
        FilterPresenter $filterItemPresenter,
        GetUserFiltersForAuthUserAction $getUserFilterForAuthUserAction,
        DeleteFilterByIdAction $deleteFilterByIdAction,
        UpdateFilterByIdAction $updateFilterByIdAction
    ) {
        $this->saveUserFilterAction = $saveUserFilterAction;
        $this->renameFilterByIdAction = $renameFilterByIdAction;
        $this->filterPresenter = $filterItemPresenter;
        $this->getUserFilterForAuthUserAction = $getUserFilterForAuthUserAction;
        $this->deleteFilterByIdAction = $deleteFilterByIdAction;
        $this->updateFilterByIdAction = $updateFilterByIdAction;
    }

    public function getFiltersForAuthUser(): JsonResponse
    {
        $response = $this->getUserFilterForAuthUserAction->execute();

        return $this->successResponse(
            $this->filterPresenter->presentCollection($response->getUserFilters())
        );
    }

    public function renameFilterById(string $id, RenameFilterByIdHttpRequest $request): JsonResponse
    {
        $response = $this->renameFilterByIdAction->execute(
            new RenameFilterByIdRequest(
                $request->name,
                (int)$id
            )
        );

        return $this->successResponse(
            $this->filterPresenter->present($response->getFilter())
        );
    }

    public function saveFilter(SaveUserFilterHttpRequest $request)
    {
        $response = $this->saveUserFilterAction->execute(
            new SaveUserFilterRequest(
                $request->name,
                $request->filter_items,
            )
        );
        return $this->successResponse(
            $this->filterPresenter->present($response->getFilter())
        );
    }

    public function deleteFilterById(string $id): JsonResponse
    {
        $this->deleteFilterByIdAction->execute(
            new ByIdRequest((int)$id)
        );

        return $this->emptyResponse();
    }

    public function updateFilterById(string $id, UpdateFilterByIdHttpRequest $request)
    {
        $response = $this->updateFilterByIdAction->execute(
            new UpdateFilterByIdRequest(
                (int)$id,
                $request->filter_items
            )
        );

        return $this->successResponse(
            $this->filterPresenter->present($response->getFilter())
        );
    }
}

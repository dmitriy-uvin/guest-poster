<?php

namespace App\Action\Filter;

use App\Exceptions\Filter\FilterNotFoundException;
use App\Exceptions\User\UserNotFoundException;
use App\Models\Filter;
use App\Models\FilterItem;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class UpdateFilterByIdAction
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(UpdateFilterByIdRequest $request): UpdateFilterByIdResponse
    {
        $user = $this->userRepository->getById(Auth::id());

        if (is_null($user)) {
            throw new UserNotFoundException();
        }

        $filter = Filter::find($request->getFilterId());

        if (is_null($filter)) {
            throw new FilterNotFoundException();
        }

        $filter->filterItems()->delete();

        foreach ($request->getFilterItems() as $filterItem) {
            $filterItemObj = new FilterItem();
            $filterItemObj->filter_id = $filter->id;
            $filterItemObj->name = $filterItem['name'];
            if (array_key_exists('from', $filterItem)) {
                $filterItemObj->from = $filterItem['from'];
            }
            if (array_key_exists('to', $filterItem)) {
                $filterItemObj->to = $filterItem['to'];
            }
            if (array_key_exists('value', $filterItem)) {
                $filterItemObj->value = $filterItem['value'];
            }
            if (array_key_exists('items', $filterItem)) {
                $filterItemObj->items = $filterItem['items'];
            }
            $filterItemObj->type = $filterItem['type'];
            $filterItemObj->property = $filterItem['property'];
            $filterItemObj->column_name = $filterItem['column_name'];
            $filterItemObj->save();
        }

        return new UpdateFilterByIdResponse($filter);
    }
}

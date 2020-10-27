<?php

declare(strict_types=1);

namespace App\Action\Filter;

use App\Models\Filter;
use App\Models\FilterItem;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

final class SaveUserFilterAction
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(SaveUserFilterRequest $request)
    {
        $user = $this->userRepository->getById(Auth::id());

        $filter = new Filter();
        $filter->name = $request->getName();
        $filter->save();

        foreach ($request->getFilterItems() as $filterItem) {
            $filterItemObj = new FilterItem();
            $filterItemObj->filter_id = $filter->id;
            $filterItemObj->name = $filterItem['name'];
            $filterItemObj->from = $filterItem['from'];
            $filterItemObj->to = $filterItem['to'];
            $filterItemObj->value = $filterItem['value'];
            $filterItemObj->items = $filterItem['items'];
            $filterItemObj->property = $filterItem['property'];
            $filterItemObj->column_name = $filterItem['column_name'];
            $filterItemObj->save();
        }

        $user->filters()->attach($filter->id);
    }
}

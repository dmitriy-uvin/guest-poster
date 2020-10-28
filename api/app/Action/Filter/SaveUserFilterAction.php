<?php

declare(strict_types=1);

namespace App\Action\Filter;

use App\Exceptions\Filter\MaxAmountOfCustomFiltersException;
use App\Models\Constants\FilterConstants;
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

    public function execute(SaveUserFilterRequest $request): SaveUserFilterResponse
    {
        $user = $this->userRepository->getById(Auth::id());

        if ($user->filters->count() === FilterConstants::MAX_AMOUNT_CUSTOM_FILTERS) {
            throw new MaxAmountOfCustomFiltersException();
        }

        $filter = new Filter();
        $filter->name = $request->getName();
        $filter->save();

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

        $user->filters()->attach($filter->id);

        return new SaveUserFilterResponse($filter);
    }
}

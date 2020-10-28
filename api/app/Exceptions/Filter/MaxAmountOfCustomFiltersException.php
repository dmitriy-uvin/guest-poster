<?php

namespace App\Exceptions\Filter;

use App\Exceptions\BaseException;
use App\Models\Constants\FilterConstants;

class MaxAmountOfCustomFiltersException extends BaseException
{
    protected $message = 'You can have only ' . FilterConstants::MAX_AMOUNT_CUSTOM_FILTERS . ' filters!';
}

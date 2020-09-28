<?php

namespace App\Http\Requests\Order;


use App\Http\Requests\ApiFormRequest;
use App\Models\Constants\OrderStatus;
use Illuminate\Validation\Rule;

class ChangeOrderStatusHttpRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'status' => [
                Rule::in(OrderStatus::getAllStatuses()),
                'required',
                'string'
            ]
        ];
    }
}

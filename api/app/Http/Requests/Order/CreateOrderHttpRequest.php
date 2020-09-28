<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Validation\Rule;

class CreateOrderHttpRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'type' => Rule::in(OrderTypes::getAllTypes()),
            'platform_ids' => 'required|array',
            'comment' => 'string|nullable'
        ];
    }
}

<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Validation\Rule;

class GetOrderByIdHttpRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'sorting' => 'string|nullable',
            'direction' => [
                Rule::in(['desc', 'asc']),
                'string',
                'nullable'
            ]
        ];
    }
}

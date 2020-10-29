<?php

namespace App\Http\Requests\Filter;

use App\Http\Requests\ApiFormRequest;

class RenameFilterByIdHttpRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string'
        ];
    }
}

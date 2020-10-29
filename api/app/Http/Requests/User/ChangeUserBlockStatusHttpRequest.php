<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiFormRequest;

class ChangeUserBlockStatusHttpRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'block_status' => 'required|boolean'
        ];
    }
}

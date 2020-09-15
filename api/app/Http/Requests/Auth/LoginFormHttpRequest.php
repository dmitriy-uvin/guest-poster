<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiFormRequest;

class LoginFormHttpRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ];
    }
}

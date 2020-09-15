<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiFormRequest;

class ResetPasswordHttpRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|min:8|string|confirmed'
        ];
    }
}

<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiFormRequest;

class ForgotPasswordRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email'
        ];
    }
}

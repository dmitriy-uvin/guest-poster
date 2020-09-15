<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiFormRequest;

class RegisterFormHttpRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string|min:8|confirmed',
            'skype' => 'string|nullable',
            'website' => 'string|nullable'
        ];
    }
}

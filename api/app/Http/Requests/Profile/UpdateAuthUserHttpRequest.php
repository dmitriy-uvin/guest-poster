<?php

namespace App\Http\Requests\Profile;

use App\Http\Requests\ApiFormRequest;

class UpdateAuthUserHttpRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'name' => 'string',
            'skype' => 'string',
            'website' => 'string',
        ];
    }
}

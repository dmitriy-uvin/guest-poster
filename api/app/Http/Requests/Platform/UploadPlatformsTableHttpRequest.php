<?php

namespace App\Http\Requests\Platform;

use App\Http\Requests\ApiFormRequest;

class UploadPlatformsTableHttpRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'platforms_table' => 'required|file',
        ];
    }
}

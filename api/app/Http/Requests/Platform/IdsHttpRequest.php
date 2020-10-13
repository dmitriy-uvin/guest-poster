<?php

declare(strict_types=1);

namespace App\Http\Requests\Platform;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class IdsHttpRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'ids' => 'required|array',
            'ids.*' => 'integer'
        ];
    }
}

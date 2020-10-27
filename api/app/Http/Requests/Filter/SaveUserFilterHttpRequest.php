<?php

namespace App\Http\Requests\Filter;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class SaveUserFilterHttpRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string',
            'filter_items' => 'required',
        ];
    }
}

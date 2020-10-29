<?php

namespace App\Http\Requests\Filter;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFilterByIdHttpRequest extends FormRequest
{
    public function rules()
    {
        return [
            'filter_items' => 'required|array'
        ];
    }
}

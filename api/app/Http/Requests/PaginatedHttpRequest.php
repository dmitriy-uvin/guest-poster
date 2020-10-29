<?php

namespace App\Http\Requests;

class PaginatedHttpRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'page' => 'integer',
            'perPage' => 'integer',
            'sorting' => 'string|nullable',
            'direction' => 'string|nullable'
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
}

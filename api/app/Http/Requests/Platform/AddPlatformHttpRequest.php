<?php

namespace App\Http\Requests\Platform;

use App\Http\Requests\ApiFormRequest;

class AddPlatformHttpRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'website_url' => 'required|string',
            'dr' => 'required|integer',
            'ma' => 'required|integer',
            'organic_traffic' => 'required|integer',
            'do_follow_active' => 'required|boolean',
            'free_home_featured_active' => 'required|boolean',
            'niche_edit_link_active' => 'required|boolean',
            'article_writing_price' => 'required|numeric',
            'niche_edit_link_price' => 'nullable|numeric',
            'contacts' => 'required|string',
            'price' => 'required|numeric',
            'email' => 'required|string',
            'comment' => 'required|string',
        ];
    }
}

<?php

namespace App\Http\Requests\Platform;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePlatformHttpRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'website_url' => 'required|string',
            'organic_traffic' => 'required',
            'dofollow_active' => 'required|boolean',
            'free_home_featured_active' => 'required|boolean',
            'niche_edit_link_active' => 'required|boolean',
            'article_writing_price' => 'required|numeric',
            'niche_edit_link_price' => 'nullable|numeric',
            'topics' => 'required|array',
            'contacts' => 'string|max:255|nullable',
            'price' => 'required|numeric',
            'description' => 'required|string|max:255',
            'article_requirements' => 'required|string|max:255',
            'deadline' => 'required|integer|min:1|max:60',
            'where_posted' => 'required|string|max:255',
            'email' => 'required|string',
            'comment' => 'string|max:255|nullable',
            'trust' => 'required',
            'spam' => 'required',
            'power_trust' => 'required',
            'moz' => 'required',
            'moz.da' => 'nullable',
            'moz.pa' => 'nullable',
            'moz.links_in' => 'nullable',
            'moz.rank' => 'nullable',
            'moz.equity' => 'nullable',
            'alexa' => 'required',
            'alexa.rank' => 'nullable',
            'alexa.country' => 'nullable|string',
            'alexa.country_rank' => 'nullable',
            'semrush' => 'required',
            'semrush.keyword_num' => 'nullable',
            'semrush.rank' => 'nullable',
            'semrush.traffic_costs' => 'nullable',
            'facebook.comments' => 'nullable',
            'facebook.reactions' => 'nullable',
            'facebook.shares' => 'nullable',
            'majestic' => 'required',
            'majestic.tf' => 'nullable',
            'majestic.cf' => 'nullable',
            'majestic.external_backlinks' => 'nullable',
            'majestic.external_edu' => 'nullable',
            'majestic.external_gov' => 'nullable',
            'majestic.refd' => 'nullable',
            'majestic.refd_edu' => 'nullable',
            'majestic.refd_gov' => 'nullable',
            'ahrefs' => 'nullable',
            'ahrefs.rank' => 'nullable',
            'ahrefs.dr' => 'nullable',
            'ahrefs.external_backlinks' => 'nullable',
            'ahrefs.refd' => 'nullable',
            'ahrefs.dofollow' => 'nullable',
        ];
    }
}

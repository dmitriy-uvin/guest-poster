<?php

namespace App\Http\Requests\Platform;

use App\Http\Requests\ApiFormRequest;

class AddPlatformHttpRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'website_url' => 'required|string',
            'ma' => 'required|integer',
            'dr' => 'required|integer',
            'organic_traffic' => 'required|integer',
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
            'moz' => 'required',
            'moz.da' => 'required|integer',
            'moz.pa' => 'required|integer',
            'moz.links_in' => 'required|integer',
            'moz.mozrank' => 'required|numeric',
            'moz.equity' => 'required|numeric',
            'alexa' => 'required',
            'alexa.rank' => 'required|numeric',
            'alexa.country' => 'required|string',
            'alexa.country_rank' => 'required|numeric',
            'semrush' => 'required',
            'semrush.keyword_num' => 'required|integer',
            'semrush.rank' => 'required|numeric',
            'semrush.traffic_costs' => 'required|integer',
            'fb.fb_comments' => 'required|integer',
            'fb.fb_reac' => 'required|integer',
            'fb.fb_shares' => 'required|integer',
            'majestic' => 'required',
            'majestic.tf' => 'required|integer',
            'majestic.cf' => 'required|integer',
            'majestic.external_backlinks' => 'required|integer',
            'majestic.external_edu' => 'required|integer',
            'majestic.external_gov' => 'required|integer',
            'ahrefs' => 'nullable',
            'ahrefs.status' => 'nullable|string',
            'ahrefs.rank' => 'nullable|numeric',
            'ahrefs.dr' => 'nullable|numeric',
            'ahrefs.eb' => 'nullable|integer',
            'ahrefs.rd' => 'nullable|integer',
            'ahrefs.dofollow' => 'nullable|integer',
            'ahrefs.ips' => 'nullable|integer',
        ];
    }
}

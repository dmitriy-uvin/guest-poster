<?php

namespace App\Http\Requests\Platform;

use App\Http\Requests\ApiFormRequest;

class AddPlatformHttpRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'website_url' => 'required|string',
            'organic_traffic' => 'required|string',
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
            'trust' => 'string',
            'spam' => 'string',
            'lrt_power_trust' => 'string',
            'moz' => 'required',
            'moz.da' => 'required',
            'moz.pa' => 'required',
            'moz.links_in' => 'required',
            'moz.mozrank' => 'required',
            'moz.equity' => 'required',
            'alexa' => 'required',
            'alexa.rank' => 'required',
            'alexa.country' => 'required|string',
            'alexa.country_rank' => 'required',
            'semrush' => 'required',
            'semrush.keyword_num' => 'required',
            'semrush.rank' => 'required',
            'semrush.traffic_costs' => 'required',
            'fb.fb_comments' => 'required|integer',
            'fb.fb_reac' => 'required|integer',
            'fb.fb_shares' => 'required|integer',
            'majestic' => 'required',
            'majestic.tf' => 'required',
            'majestic.cf' => 'required',
            'majestic.external_backlinks' => 'required',
            'majestic.external_edu' => 'required',
            'majestic.external_gov' => 'required',
            'ahrefs' => 'nullable',
            'ahrefs.status' => 'nullable|string',
            'ahrefs.rank' => 'nullable',
            'ahrefs.dr' => 'nullable',
            'ahrefs.eb' => 'nullable',
            'ahrefs.rd' => 'nullable',
            'ahrefs.dofollow' => 'nullable',
            'ahrefs.ips' => 'nullable',
        ];
    }
}

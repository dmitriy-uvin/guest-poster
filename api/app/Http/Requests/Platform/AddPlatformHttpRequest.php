<?php

namespace App\Http\Requests\Platform;

use App\Http\Requests\ApiFormRequest;

class AddPlatformHttpRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'website_url' => 'required|string',
            'da' => 'required|integer',
            'dr' => 'required|integer',
            'organic_traffic' => 'required|integer',
            'dofollow_active' => 'required|boolean',
            'free_home_featured_active' => 'required|boolean',
            'niche_edit_link_active' => 'required|boolean',
            'article_writing_price' => 'required|numeric',
            'niche_edit_link_price' => 'nullable|numeric',
            'topics' => 'required|array',
            'contacts' => 'required|string',
            'price' => 'required|numeric',
            'email' => 'required|string',
            'comment' => 'required|string',
            'moz' => 'required',
            'moz.da' => 'required|integer',
            'moz.pa' => 'required|integer',
            'moz.links_in' => 'required|integer',
            'moz.mozrank' => 'required|numeric',
            'alexa' => 'required',
            'alexa.rank' => 'required|numeric',
            'alexa.country' => 'required|string',
            'semrush' => 'required',
            'semrush.keyword_num' => 'required|integer',
            'semrush.rank' => 'required|numeric',
            'semrush.traffic' => 'required|integer',
            'semrush.traffic_costs' => 'required|integer',
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

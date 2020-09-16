<?php

namespace App\Http\Presenters\Platform;

use App\Models\Platform;
use Illuminate\Support\Collection;

class PlatformPresenter
{
    public function present(Platform $platform)
    {
        return [
            'website_url' => $platform->website_url,
            'dr' => $platform->dr,
            'ma' => $platform->ma,
            'organic_traffic' => $platform->organic_traffic,
            'do_follow' => $platform->do_follow,
            'free_home_featured' => $platform->free_home_featured,
            'article_writing_price' => $platform->article_writing_price,
            'niche_edit_link_price' => $platform->niche_edit_link_price,
            'contacts' => $platform->contacts,
            'price' => $platform->price,
            'email' => $platform->comment,
        ];
    }

    public function presentCollection(Collection $platforms)
    {
        return $platforms->map(function ($platform) {
            return $this->present($platform);
        });
    }
}

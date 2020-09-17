<?php

namespace App\Http\Presenters\Platform;

use App\Http\Presenters\Contracts\PresenterCollectionInterface;
use App\Http\Presenters\Topic\TopicPresenter;
use App\Models\Platform;
use Illuminate\Support\Collection;

final class PlatformPresenter implements PresenterCollectionInterface
{
    private TopicPresenter $topicPresenter;

    public function __construct(TopicPresenter $topicPresenter)
    {
        $this->topicPresenter = $topicPresenter;
    }

    public function present(Platform $platform)
    {
        return [
            'id' => $platform->id,
            'website_url' => $platform->website_url,
            'dr' => $platform->dr,
            'ma' => $platform->ma,
            'organic_traffic' => $platform->organic_traffic,
            'do_follow_active' => $platform->do_follow_active,
            'free_home_featured_active' => $platform->free_home_featured_active,
            'niche_edit_link_active' => $platform->niche_edit_link_active,
            'article_writing_price' => $platform->article_writing_price,
            'niche_edit_link_price' => $platform->niche_edit_link_price,
            'contacts' => $platform->contacts,
            'price' => $platform->price,
            'email' => $platform->email,
            'comment' => $platform->comment,
            'topics' => $this->topicPresenter->presentCollection($platform->topics)
        ];
    }

    public function presentCollection(Collection $platforms)
    {
        return $platforms->map(function ($platform) {
            return $this->present($platform);
        })->toArray();
    }
}

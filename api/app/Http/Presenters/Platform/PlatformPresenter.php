<?php

namespace App\Http\Presenters\Platform;

use App\Http\Presenters\Ahrefs\AhrefsPresenter;
use App\Http\Presenters\Alexa\AlexaPresenter;
use App\Http\Presenters\Contracts\PresenterCollectionInterface;
use App\Http\Presenters\Majestic\MajesticPresenter;
use App\Http\Presenters\Moz\MozPresenter;
use App\Http\Presenters\SemRush\SemRushPresenter;
use App\Http\Presenters\Topic\TopicPresenter;
use App\Models\Moz;
use App\Models\Platform;
use Illuminate\Support\Collection;

final class PlatformPresenter implements PresenterCollectionInterface
{
    private TopicPresenter $topicPresenter;
    private MozPresenter $mozPresenter;
    private AlexaPresenter $alexaPresenter;
    private SemRushPresenter $semRushPresenter;
    private MajesticPresenter $majesticPresenter;
    private AhrefsPresenter $ahrefsPresenter;

    public function __construct(
        TopicPresenter $topicPresenter,
        MozPresenter $mozPresenter,
        AlexaPresenter $alexaPresenter,
        SemRushPresenter $semRushPresenter,
        MajesticPresenter $majesticPresenter,
        AhrefsPresenter $ahrefsPresenter
    ) {
        $this->topicPresenter = $topicPresenter;
        $this->mozPresenter = $mozPresenter;
        $this->alexaPresenter = $alexaPresenter;
        $this->semRushPresenter = $semRushPresenter;
        $this->majesticPresenter = $majesticPresenter;
        $this->ahrefsPresenter = $ahrefsPresenter;
    }

    public function present(Platform $platform)
    {
        return [
            'id' => $platform->id,
            'website_url' => $platform->website_url,
            'dr' => $platform->dr,
            'da' => $platform->da,
            'organic_traffic' => $platform->organic_traffic,
            'dofollow_active' => $platform->dofollow_active,
            'free_home_featured_active' => $platform->free_home_featured_active,
            'niche_edit_link_active' => $platform->niche_edit_link_active,
            'article_writing_price' => $platform->article_writing_price,
            'niche_edit_link_price' => $platform->niche_edit_link_price,
            'contacts' => $platform->contacts,
            'price' => $platform->price,
            'email' => $platform->email,
            'comment' => $platform->comment,
            'topics' => $this->topicPresenter->presentCollection($platform->topics),
            'moz' => $this->mozPresenter->present($platform->moz),
            'alexa' => $this->alexaPresenter->present($platform->alexa),
            'semrush' => $this->semRushPresenter->present($platform->semrush),
            'majestic' => $this->majesticPresenter->present($platform->majestic),
            'ahrefs' => $platform->ahrefs ? $this->ahrefsPresenter->present($platform->ahrefs) : null
        ];
    }

    public function presentCollection(Collection $platforms)
    {
        return $platforms->map(function ($platform) {
            return $this->present($platform);
        })->toArray();
    }
}

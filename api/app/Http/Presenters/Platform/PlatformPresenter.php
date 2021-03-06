<?php

namespace App\Http\Presenters\Platform;

use App\Http\Presenters\Ahrefs\AhrefsPresenter;
use App\Http\Presenters\Alexa\AlexaPresenter;
use App\Http\Presenters\Contracts\PresenterCollectionInterface;
use App\Http\Presenters\Fb\FbPresenter;
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
    private FbPresenter $fbPresenter;

    public function __construct(
        TopicPresenter $topicPresenter,
        MozPresenter $mozPresenter,
        AlexaPresenter $alexaPresenter,
        SemRushPresenter $semRushPresenter,
        MajesticPresenter $majesticPresenter,
        AhrefsPresenter $ahrefsPresenter,
        FbPresenter $fbPresenter
    ) {
        $this->topicPresenter = $topicPresenter;
        $this->mozPresenter = $mozPresenter;
        $this->alexaPresenter = $alexaPresenter;
        $this->semRushPresenter = $semRushPresenter;
        $this->majesticPresenter = $majesticPresenter;
        $this->ahrefsPresenter = $ahrefsPresenter;
        $this->fbPresenter = $fbPresenter;
    }

    public function present(Platform $platform)
    {
        return [
            'id' => $platform->id,
            'protocol' => $platform->protocol,
            'website_url' => $platform->website_url,
            'organic_traffic' => $platform->organic_traffic,
            'dofollow_active' => $platform->dofollow_active,
            'free_home_featured_active' => $platform->free_home_featured_active,
            'niche_edit_link_active' => $platform->niche_edit_link_active,
            'money_anchor' => $platform->money_anchor,
            'article_writing_price' => $platform->article_writing_price,
            'niche_edit_link_price' => $platform->niche_edit_link_price,
            'created_at' => $platform->created_at,
            'updated_at' => $platform->updated_at,
            'article_requirements' => $platform->article_requirements,
            'deadline' => $platform->deadline,
            'description' => $platform->description,
            'where_posted' => $platform->where_posted,
            'domain_zone' => $platform->domain_zone,
            'contacts' => $platform->contacts,
            'price' => $platform->price,
            'email' => $platform->email,
            'comment' => $platform->comment,
            'trust' => $platform->trust,
            'spam' => $platform->spam,
            'in_trash' => $platform->in_trash,
            'lrt_power_trust' => $platform->lrt_power_trust,
            'topics' => $this->topicPresenter->presentCollection($platform->topics),
            'moz' => $this->mozPresenter->present($platform->moz),
            'alexa' => $this->alexaPresenter->present($platform->alexa),
            'semrush' => $this->semRushPresenter->present($platform->semrush),
            'majestic' => $this->majesticPresenter->present($platform->majestic),
            'ahrefs' => $platform->ahrefs ? $this->ahrefsPresenter->present($platform->ahrefs) : null,
            'fb' => $this->fbPresenter->present($platform->facebook)
        ];
    }

    public function presentCollection(Collection $platforms)
    {
        return $platforms->map(function ($platform) {
            return $this->present($platform);
        })->toArray();
    }
}

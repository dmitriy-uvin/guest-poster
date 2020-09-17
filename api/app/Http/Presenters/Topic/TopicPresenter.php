<?php

declare(strict_types=1);

namespace App\Http\Presenters\Topic;

use App\Http\Presenters\Contracts\PresenterCollectionInterface;
use App\Models\Topic;
use Illuminate\Support\Collection;

final class TopicPresenter implements PresenterCollectionInterface
{
    public function present(Topic $topic)
    {
        return [
            'id' => $topic->id,
            'name' => $topic->name,
        ];
    }

    public function presentCollection(Collection $topics)
    {
        return $topics->map(function ($topic) {
            return $this->present($topic);
        })->toArray();
    }
}

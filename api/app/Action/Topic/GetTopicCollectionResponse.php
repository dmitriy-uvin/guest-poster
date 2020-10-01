<?php

declare(strict_types=1);

namespace App\Action\Topic;

use Illuminate\Support\Collection;

final class GetTopicCollectionResponse
{
    private Collection $topics;

    public function __construct(Collection $topics)
    {
        $this->topics = $topics;
    }

    public function getTopics(): Collection
    {
        return $this->topics;
    }
}

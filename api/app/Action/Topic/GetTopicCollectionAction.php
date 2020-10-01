<?php

declare(strict_types=1);

namespace App\Action\Topic;

use App\Models\Topic;

final class GetTopicCollectionAction
{
    public function execute()
    {
        $topics = Topic::all();
        return new GetTopicCollectionResponse($topics);
    }
}

<?php

declare(strict_types=1);

namespace App\Repositories\Order\Criterion;

use App\Contracts\EloquentCriterion;
use Illuminate\Database\Eloquent\Builder;

final class UserIdCriterion implements EloquentCriterion
{
    private int $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function build(Builder $builder): Builder
    {
        return $builder->where('user_id', $this->userId);
    }
}

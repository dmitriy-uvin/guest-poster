<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface EloquentCriterion
{
    public function build(Builder $builder): Builder;
}

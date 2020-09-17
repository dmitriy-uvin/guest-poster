<?php

declare(strict_types=1);

namespace App\Http\Presenters\Contracts;

use Illuminate\Support\Collection;

interface PresenterCollectionInterface
{
    public function presentCollection(Collection $collection);
}

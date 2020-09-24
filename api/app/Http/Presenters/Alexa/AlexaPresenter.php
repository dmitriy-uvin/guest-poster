<?php

declare(strict_types=1);

namespace App\Http\Presenters\Alexa;

use App\Models\Alexa;

final class AlexaPresenter
{
    public function present(Alexa $alexa)
    {
        return [
            'rank' => $alexa->rank,
            'country' => $alexa->country
        ];
    }
}

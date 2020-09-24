<?php

declare(strict_types=1);

namespace App\Http\Presenters\Majestic;

use App\Models\Majestic;

final class MajesticPresenter
{
    public function present(Majestic $majestic)
    {
        return [
            'external_backlinks' => $majestic->external_backlinks,
            'external_gov' => $majestic->external_gov,
            'external_edu' => $majestic->external_edu,
            'tf' => $majestic->tf,
            'cf' => $majestic->cf,
        ];
    }
}

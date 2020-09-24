<?php

declare(strict_types=1);

namespace App\Http\Presenters\Moz;

use App\Models\Moz;

final class MozPresenter
{
    public function present($moz)
    {
        return [
            'pa' => $moz->pa,
            'da' => $moz->da,
            'rank' => $moz->rank,
            'links_in' => $moz->links_in,
        ];
    }
}

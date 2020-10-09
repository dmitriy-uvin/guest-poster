<?php

declare(strict_types=1);

namespace App\Http\Presenters\SemRush;

use App\Models\SemRush;

final class SemRushPresenter
{
    public function present(SemRush $semRush)
    {
        return [
            'rank' => $semRush->rank,
            'keyword_num' => $semRush->keyword_num,
            'traffic_costs' => $semRush->traffic_costs,
        ];
    }
}

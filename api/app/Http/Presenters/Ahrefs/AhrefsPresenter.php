<?php

declare(strict_types=1);

namespace App\Http\Presenters\Ahrefs;

use App\Models\Ahrefs;

class AhrefsPresenter
{
    public function present(Ahrefs $ahrefs)
    {
        return [
            'status' => $ahrefs->status,
            'rank' => $ahrefs->rank,
            'dr' => $ahrefs->dr,
            'eb' => $ahrefs->eb,
            'rd' => $ahrefs->rd,
            'dofollow' => $ahrefs->dofollow,
            'ips' => $ahrefs->ips,
        ];
    }
}

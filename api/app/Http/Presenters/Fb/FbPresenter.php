<?php

declare(strict_types=1);

namespace App\Http\Presenters\Fb;

use App\Models\Facebook;

final class FbPresenter
{
    public function present(Facebook $fb)
    {
        return [
            'comments' => $fb->fb_comments,
            'reactions' => $fb->fb_reac,
            'shares' => $fb->fb_shares,
        ];
    }
}

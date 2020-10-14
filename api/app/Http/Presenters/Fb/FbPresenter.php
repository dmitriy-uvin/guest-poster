<?php

declare(strict_types=1);

namespace App\Http\Presenters\Fb;

use App\Models\Facebook;

final class FbPresenter
{
    public function present(Facebook $fb)
    {
        return [
            'fb_comments' => $fb->fb_comments,
            'fb_reac' => $fb->fb_reac,
            'fb_shares' => $fb->fb_shares,
        ];
    }
}

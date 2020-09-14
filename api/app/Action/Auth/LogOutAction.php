<?php

declare(strict_types=1);

namespace App\Action\Auth;

use Illuminate\Support\Facades\Auth;

final class LogOutAction
{
    public function execute(): void
    {
        Auth::logout();
    }
}

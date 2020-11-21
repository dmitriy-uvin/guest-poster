<?php

namespace App\Jobs;

use App\Mail\SuccessRegistrationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendRegisterEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function handle()
    {
        Mail::to([$this->email])
            ->send(
                new SuccessRegistrationMail($this->email)
            );
    }
}

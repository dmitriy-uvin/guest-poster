<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Lang;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    private string $linkReset;

    public function __construct(string $linkReset)
    {
        $this->linkReset = $linkReset;
    }

    public function build()
    {
        return (new MailMessage())
            ->subject('Reset Password from '. env('APP_NAME'))
            ->line('We’ve received a request to reset your password. If you didn’t make the
        request, just ignore this email.')
            ->line('Otherwise, you can reset your password using this link:')
            ->action('Begin process of changing password', $this->linkReset);
    }
}

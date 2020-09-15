<?php

namespace App\Notifications;

use App\Mail\ResetPasswordMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    private string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $linkReset =$this->resetUrl($notifiable, $this->token);
        return (new ResetPasswordMail($linkReset))->build();
    }

    protected function resetUrl($notifiable, $token)
    {
        return  env('CLIENT_APP_URL') . '/reset-password?' . http_build_query(
            [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ]
        );
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

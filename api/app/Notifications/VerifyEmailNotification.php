<?php

namespace App\Notifications;

use App\Mail\EmailVerificationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyEmailNotification extends Notification
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new EmailVerificationMail())
            ->build($this->verificationUrl($notifiable));
    }

    protected function verificationUrl($notifiable)
    {
        return  env('CLIENT_APP_URL') . '/verified-email?' . http_build_query(
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->email),
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

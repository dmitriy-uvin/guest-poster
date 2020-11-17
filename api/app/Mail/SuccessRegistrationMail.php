<?php

namespace App\Mail;

use App\Exceptions\User\UserNotFoundException;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SuccessRegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    private string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function build()
    {
        return $this
            ->subject('Guest Poster Registration!')
            ->markdown('emails.success_registration')
            ->with([
            'url' => $this->getVerificationUrl()
        ]);
    }

    protected function getVerificationUrl()
    {
        $user = User::where('email', '=', $this->email)->get()->first();

        if (is_null($user)) {
            throw new UserNotFoundException();
        }

        return  env('CLIENT_APP_URL') . '/verified-email?' . http_build_query(
            [
                'id' => $user->id,
                'hash' => sha1($user->email),
            ]
        );
    }
}

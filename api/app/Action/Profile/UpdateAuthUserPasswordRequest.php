<?php

namespace App\Action\Profile;

final class UpdateAuthUserPasswordRequest
{
    private string $oldPassword;
    private string $newPassword;
    private string $newPasswordConfirmation;

    public function __construct(
        string $oldPassword,
        string $newPassword,
        string $newPasswordConfirmation
    ) {
        $this->oldPassword = $oldPassword;
        $this->newPassword = $newPassword;
        $this->newPasswordConfirmation = $newPasswordConfirmation;
    }

    public function getOldPassword(): string
    {
        return $this->oldPassword;
    }

    public function getNewPassword(): string
    {
        return $this->newPassword;
    }

    public function getNewPasswordConfirmation(): string
    {
        return $this->newPasswordConfirmation;
    }
}

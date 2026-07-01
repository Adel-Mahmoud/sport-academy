<?php
namespace App\Domains\Auth\Actions;

use App\Domains\Auth\DTOs\LoginData;

class LoginAction
{
    public function execute(LoginData $data): bool
    {
        return auth()->guard('web')->attempt([
            'email'    => $data->email,
            'password' => $data->password,
        ]);
    }
}
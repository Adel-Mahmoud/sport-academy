<?php

namespace App\Domains\Users\Services;

use Illuminate\Support\Facades\Hash;
use App\Domains\Auth\Models\Admin;
use App\Domains\Users\DTOs\CreateUserData;

class UserService
{
    public function registerUser(CreateUserData $data): Admin
    {
        $user = Admin::create([
            'name'     => $data->name,
            'email'    => $data->email,
            'password' => Hash::make($data->password),
        ]);

        return $user;
    }
}

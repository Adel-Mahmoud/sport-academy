<?php

namespace App\Domains\Users\Services;

use Illuminate\Support\Facades\Hash;
use App\Domains\Auth\Models\Admin as User;

class UserService
{
    public function registerUser(array $data): User
    {
        $user = User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => Hash::make($data['password']), 
            ]);

            if (isset($data['roles'])) {
                $user->syncRoles($data['roles']);
            }

        return $user;
    }
}

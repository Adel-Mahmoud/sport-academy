<?php

namespace App\Domains\Users\Services;

use Illuminate\Support\Facades\Hash;
use App\Domains\Auth\Models\Admin;
use App\Domains\Users\DTOs\CreateUserData;
use Spatie\Permission\Models\Role;

class UserService
{
    public function registerUser(CreateUserData $data): Admin
    {
        $user = Admin::create([
            'name'     => $data->name,
            'email'    => $data->email,
            'password' => Hash::make($data->password),
        ]);

        if (!empty($data->roles)) {
            foreach ($data->roles as $roleName) {
                Role::firstOrCreate([
                    'name'       => $roleName,
                    'guard_name' => 'admin',
                ]);

                $user->assignRole($roleName);
            }
        }

        return $user;
    }
}

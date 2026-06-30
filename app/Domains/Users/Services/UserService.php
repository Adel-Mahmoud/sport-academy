<?php

namespace App\Domains\Users\Services;

use Illuminate\Support\Facades\Hash;
use App\Domains\Auth\Models\Admin;
use App\Domains\Users\DTOs\CreateUserData;
use App\Domains\Users\DTOs\UpdateUserData;
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

    public function updateUser(UpdateUserData $data): Admin
    {
        $user = Admin::findOrFail($data->id);

        $user->update([
            'name'     => $data->name,
            'email'    => $data->email,
            'password' => !is_null($data->password) ? Hash::make($data->password) : $user->password,
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

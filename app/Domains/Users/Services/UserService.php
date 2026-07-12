<?php

namespace App\Domains\Users\Services;

use Illuminate\Support\Facades\Hash;
use App\Domains\Users\Models\User;
use App\Domains\Users\DTOs\CreateUserData;
use App\Domains\Users\DTOs\UpdateUserData;
use Spatie\Permission\Models\Role;

class UserService
{
    public function registerUser(CreateUserData $data): User
    {
        $user = User::create([
            'name'     => $data->name,
            'email'    => $data->email,
            'password' => Hash::make($data->password),
            'type'     => $data->type,
            'is_active' => $data->is_active,
        ]);

        if (!empty($data->roles)) {
            foreach ($data->roles as $roleName) {
                Role::firstOrCreate([
                    'name'       => $roleName,
                    'guard_name' => 'web',
                ]);

                $user->assignRole($roleName);
            }
        }

        return $user;
    }

    public function updateUser(UpdateUserData $data): User
    {
        $user = User::findOrFail($data->id);

        $user->update([
            'name'     => $data->name,
            'email'    => $data->email,
            'password' => !is_null($data->password) ? Hash::make($data->password) : $user->password,
            'type'     => $data->type ?? $user->type,
            'is_active' => $data->is_active,
        ]);

        if (!empty($data->roles)) {
            foreach ($data->roles as $roleName) {
                Role::firstOrCreate([
                    'name'       => $roleName,
                    'guard_name' => 'web',
                ]);

                $user->assignRole($roleName);
            }
        }

        return $user;
    }
}

<?php

namespace App\Domains\Users\Repositories;

use App\Domains\Users\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserRepository
{
    public function all()
    {
        return User::with('roles')->latest()->get();
    }

    public function find(int $id): User
    {
        return User::with('roles')->findOrFail($id);
    }

    public function create(array $data): User
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $roles = $data['roles'] ?? [];
        unset($data['roles']);

        $user = User::create($data);

        if (!empty($roles)) {
            $this->assignRoles($user, $roles);
        }

        return $user;
    }

    public function update(int $id, array $data): User
    {
        $user = $this->find($id);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $roles = $data['roles'] ?? null;
        unset($data['roles']);

        $user->update($data);

        if ($roles !== null) {
            $this->assignRoles($user, $roles);
        }

        return $user;
    }

    public function delete(int $id): bool
    {
        $user = $this->find($id);
        
        return (bool) $user->delete();
    }

    protected function assignRoles(User $user, array $roles): void
    {
        foreach ($roles as $roleName) {
            Role::firstOrCreate([
                'name'       => $roleName,
                'guard_name' => 'web',
            ]);
        }

        $user->syncRoles($roles);
    }
}
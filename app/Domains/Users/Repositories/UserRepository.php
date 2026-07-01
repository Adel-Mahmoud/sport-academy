<?php

namespace App\Domains\Users\Repositories;

use App\Domains\Users\Models\User;
 
class UserRepository
{
    public function all()
    {
        return User::with('roles')->latest()->get();
    }

    public function find($id)
    {
        return User::with('roles')->findOrFail($id);
    }

    public function create(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

        if (isset($data['roles'])) {
            $user->syncRoles($data['roles']);
        }

        return $user;
    }

    public function update($id, array $data)
    {
        $user = $this->find($id);

        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        if (isset($data['roles'])) {
            $user->syncRoles($data['roles']);
        }

        return $user;
    }

    public function delete($id)
    {
        return User::destroy($id);
    }
}

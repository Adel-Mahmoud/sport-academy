<?php

namespace App\Domains\Users\Services;

use App\Domains\Users\Models\User;
use App\Domains\Users\DTOs\CreateUserData;
use App\Domains\Users\DTOs\UpdateUserData;
use App\Domains\Users\Repositories\UserRepository;

class UserService
{
    public function __construct(
        protected UserRepository $userRepository
    ) {}

    public function registerUser(CreateUserData $data): User
    {
        return $this->userRepository->create($data->toArray());
    }

    public function updateUser(UpdateUserData $data): User
    {
        return $this->userRepository->update($data->id, $data->toArray());
    }

    public function deleteUser(int $id): bool
    {
        return $this->userRepository->delete($id);
    }
}
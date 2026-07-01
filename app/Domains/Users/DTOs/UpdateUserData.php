<?php

namespace App\Domains\Users\DTOs;

class UpdateUserData
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $email,
        public readonly ?string $password = null,
        public readonly array $roles = [],
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            email: $data['email'],
            password: $data['password'] ?? null,
            roles: $data['roles'] ?? [],
        );
    }
}
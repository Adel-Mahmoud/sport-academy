<?php

namespace App\Domains\Users\DTOs;

class CreateUserData
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
        public readonly ?string $type = 'user',
        public readonly ?bool $is_active = true,
        public readonly array $roles = [],
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            password: $data['password'],
            type: $data['type'] ?? 'user',
            is_active: $data['is_active'] ?? true,
            roles: $data['roles'] ?? [],
        );
    }
}
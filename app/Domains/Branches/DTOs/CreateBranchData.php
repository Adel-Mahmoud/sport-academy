<?php

namespace App\Domains\Branches\DTOs;

class CreateBranchData
{
    public function __construct(
        public string $name,
        public string $address,
        public ?string $phone = null,
        public ?bool $is_active = true,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            address: $data['address'],
            phone: $data['phone'],
            is_active: $data['is_active'] ?? true
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->phone,
            'is_active' => $this->is_active,
        ];
    }
}
<?php

namespace App\Domains\Branches\DTOs;

class UpdateBranchData
{
    public function __construct(
        public string $name,
        public string $location,
        public ?bool $is_active = true,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            location: $data['location'],
            is_active: $data['is_active'] ?? true
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'location' => $this->location,
            'is_active' => $this->is_active,
        ];
    }
}
<?php

namespace App\Domains\Sports\DTOs;

class UpdateSportData
{
    public function __construct(
        public string $name,
        public int $branch_id,
        public bool $is_active = true
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            branch_id: $data['branch_id'],
            is_active: $data['is_active'] ?? true
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'branch_id' => $this->branch_id,
            'is_active' => $this->is_active,
        ];
    }
}
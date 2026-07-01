<?php

namespace App\Domains\Branches\DTOs;

class UpdateBranchData
{
    public function __construct(
        public string $name,
        public string $location,
        public ?bool $status = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            location: $data['location'],
            status: $data['status'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'location' => $this->location,
            'status' => $this->status,
        ];
    }
}
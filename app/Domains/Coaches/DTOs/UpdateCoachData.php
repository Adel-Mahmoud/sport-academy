<?php

namespace App\Domains\Coaches\DTOs;

class UpdateCoachData
{
    public function __construct(
        public string $name,
        public string $phone,
        public string $hire_date,
        public float $salary,
        public bool $is_active = true,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            phone: $data['phone'],
            hire_date: $data['hire_date'],
            salary: $data['salary'],
            is_active: $data['is_active'] ?? true
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'phone' => $this->phone,
            'hire_date' => $this->hire_date,
            'salary' => $this->salary,
            'is_active' => $this->is_active,
        ];
    }
}

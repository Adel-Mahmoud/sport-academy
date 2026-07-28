<?php

namespace App\Domains\Coaches\DTOs;

class UpdateCoachData
{
    public function __construct(
        public string $name,
        public string $phone,
        public string $hire_date,
        public float $salary,
        public bool $has_account = false,
        public bool $is_active = true,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            phone: $data['phone'],
            hire_date: $data['hire_date'],
            salary: $data['salary'],
            has_account: filter_var($data['has_account'] ?? false, FILTER_VALIDATE_BOOLEAN),
            is_active: filter_var($data['is_active'] ?? true, FILTER_VALIDATE_BOOLEAN),
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'phone' => $this->phone,
            'hire_date' => $this->hire_date,
            'salary' => $this->salary,
            'has_account' => $this->has_account,
            'is_active' => $this->is_active,
        ];
    }
}

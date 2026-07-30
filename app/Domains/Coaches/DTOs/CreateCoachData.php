<?php
namespace App\Domains\Coaches\DTOs;

class CreateCoachData
{
    public function __construct(
        public string $name,
        public string $phone,
        public string $hire_date,
        public float $salary,
        public ?string $email = null,
        public ?string $password = null,
        public bool $is_active = true,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            phone: $data['phone'],
            hire_date: $data['hire_date'],
            salary: $data['salary'],
            email: $data['email'] ?? null,
            password: $data['password'] ?? null,
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
            'email' => $this->email ?? null,
            'password' => $this->password ?? null,
            'is_active' => $this->is_active,
        ];
    }
}
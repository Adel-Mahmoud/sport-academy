<?php
namespace App\Domains\Coaches\DTOs;

class CreateCoachData
{
    public function __construct(
        public string $name,
        public string $phone,
        public string $email,
        public string $hire_date,
        public float $salary,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            phone: $data['phone'],
            email: $data['email'],
            hire_date: $data['hire_date'],
            salary: $data['salary'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'hire_date' => $this->hire_date,
            'salary' => $this->salary,
        ];
    }
}
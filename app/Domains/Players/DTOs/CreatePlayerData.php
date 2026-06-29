<?php
namespace App\Domains\Players\DTOs;

class CreatePlayerData
{
    public function __construct(
        public string $name,
        public string $phone,
        public string $national_id,
        public int $age,
        public ?string $school = null,
        public ?float $weight = null,
        public ?float $height = null,
        public ?string $blood_type = null,
        public ?string $gender = null,
        public ?string $address = null,
        public ?string $description = null,
        public ?string $location = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            phone: $data['phone'],
            national_id: $data['national_id'],
            age: $data['age'],
            school: $data['school'] ?? null,
            weight: $data['weight'] ?? null,
            height: $data['height'] ?? null,
            blood_type: $data['blood_type'] ?? null,
            gender: $data['gender'] ?? null,
            address: $data['address'] ?? null,
            description: $data['description'] ?? null,
            location: $data['location'] ?? null,
        );
    }
}
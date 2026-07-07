<?php

namespace App\Domains\Players\DTOs;

class UpdatePlayerData
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
        public ?string $image = null,
        public ?bool $is_active = true,
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
            image: $data['image'] ?? null,
            is_active: $data['is_active'] ?? true,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'phone' => $this->phone,
            'national_id' => $this->national_id,
            'age' => $this->age,
            'school' => $this->school,
            'weight' => $this->weight,
            'height' => $this->height,
            'blood_type' => $this->blood_type,
            'gender' => $this->gender,
            'address' => $this->address,
            'description' => $this->description,
            'location' => $this->location,
            'image' => $this->image,
            'is_active' => $this->is_active,
        ];
    }
}

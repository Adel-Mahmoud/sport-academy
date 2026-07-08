<?php

namespace App\Domains\Groups\DTOs;

class UpdateGroupData
{
    private string $name;
    private ?int $sport_id = null;
    private ?string $level = null;
    private ?string $description = null;
    private ?string $status = null;
    private ?string $start_date = null;
    private ?string $end_date = null;
    private ?bool $is_active = true;

    public function __construct(
        string $name,
        ?int $sport_id = null,
        ?string $level = null,
        ?string $description = null,
        ?string $status = null,
        ?string $start_date = null,
        ?string $end_date = null,
        ?bool $is_active = true
    ) {
        $this->name = $name;
        $this->sport_id = $sport_id;
        $this->level = $level;
        $this->description = $description;
        $this->status = $status;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->is_active = $is_active;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            sport_id: $data['sport_id'] ?? null,
            level: $data['level'] ?? null,
            description: $data['description'] ?? null,
            status: $data['status'] ?? null,
            start_date: $data['start_date'] ?? null,
            end_date: $data['end_date'] ?? null,
            is_active: $data['is_active'] ?? true
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'sport_id' => $this->sport_id,
            'level' => $this->level,
            'description' => $this->description,
            'status' => $this->status,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'is_active' => $this->is_active,
        ];
    }
}
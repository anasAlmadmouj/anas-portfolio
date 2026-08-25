<?php

namespace App\DataTransferObjects;

final readonly class ExperienceData
{
    /**
     * @param  array<int, string>  $technologies
     */
    public function __construct(
        public string $key,
        public ?string $periodStart,
        public ?string $periodEnd,
        public array $technologies,
    ) {}

    public static function fromConfig(array $data): self
    {
        return new self(
            key: $data['key'],
            periodStart: $data['period_start'] ?? null,
            periodEnd: $data['period_end'] ?? null,
            technologies: $data['technologies'] ?? [],
        );
    }

    public function company(): string
    {
        return trans("experience.items.{$this->key}.company");
    }

    public function position(): string
    {
        return trans("experience.items.{$this->key}.position");
    }

    public function description(): string
    {
        return trans("experience.items.{$this->key}.description");
    }

    /**
     * @return array<int, string>
     */
    public function responsibilities(): array
    {
        return trans("experience.items.{$this->key}.responsibilities");
    }
}

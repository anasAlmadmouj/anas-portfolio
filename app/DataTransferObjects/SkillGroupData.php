<?php

namespace App\DataTransferObjects;

final readonly class SkillGroupData
{
    /**
     * @param  array<int, string>  $skills
     */
    public function __construct(
        public string $key,
        public array $skills,
    ) {}

    public static function fromConfig(array $data): self
    {
        return new self(
            key: $data['key'],
            skills: $data['skills'] ?? [],
        );
    }

    public function label(): string
    {
        return trans("skills.groups.{$this->key}");
    }
}

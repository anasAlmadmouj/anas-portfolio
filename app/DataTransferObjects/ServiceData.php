<?php

namespace App\DataTransferObjects;

final readonly class ServiceData
{
    public function __construct(
        public string $key,
        public string $icon,
    ) {}

    public static function fromConfig(array $data): self
    {
        return new self(
            key: $data['key'],
            icon: $data['icon'],
        );
    }

    public function title(): string
    {
        return trans("services.items.{$this->key}.title");
    }

    public function description(): string
    {
        return trans("services.items.{$this->key}.description");
    }
}

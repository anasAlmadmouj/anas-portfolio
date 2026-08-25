<?php

namespace App\DataTransferObjects;

final readonly class ProjectData
{
    /**
     * @param  array<int, string>  $technologies
     * @param  array<int, string>  $screenshots
     */
    public function __construct(
        public string $slug,
        public string $category,
        public int $year,
        public string $status,
        public array $technologies,
        public ?string $image,
        public bool $isFeatured,
        public bool $isConfidential,
        public array $screenshots,
    ) {}

    public static function fromConfig(array $data): self
    {
        return new self(
            slug: $data['slug'],
            category: $data['category'],
            year: $data['year'],
            status: $data['status'],
            technologies: $data['technologies'] ?? [],
            image: $data['image'] ?? null,
            isFeatured: $data['is_featured'] ?? false,
            isConfidential: $data['is_confidential'] ?? false,
            screenshots: $data['screenshots'] ?? [],
        );
    }

    public function name(): string
    {
        return trans("projects.items.{$this->slug}.name");
    }

    public function shortDescription(): string
    {
        return trans("projects.items.{$this->slug}.short_description");
    }

    public function overview(): string
    {
        return trans("projects.items.{$this->slug}.overview");
    }

    public function role(): string
    {
        return trans("projects.items.{$this->slug}.role");
    }

    /**
     * @return array<int, string>
     */
    public function responsibilities(): array
    {
        return trans("projects.items.{$this->slug}.responsibilities");
    }

    public function architecture(): string
    {
        return trans("projects.items.{$this->slug}.architecture");
    }

    public function challenges(): string
    {
        return trans("projects.items.{$this->slug}.challenges");
    }

    public function solutions(): string
    {
        return trans("projects.items.{$this->slug}.solutions");
    }

    public function results(): string
    {
        return trans("projects.items.{$this->slug}.results");
    }

    public function categoryLabel(): string
    {
        return trans("projects.labels.category.{$this->category}");
    }

    public function statusLabel(): string
    {
        return trans("projects.labels.status.{$this->status}");
    }

    public function hasScreenshots(): bool
    {
        return !empty($this->screenshots);
    }

    public function primaryScreenshot(): ?string
    {
        return $this->screenshots[0] ?? $this->image;
    }

    public function secondaryScreenshot(): ?string
    {
        return $this->screenshots[1] ?? null;
    }

    public function tertiaryScreenshot(): ?string
    {
        return $this->screenshots[2] ?? null;
    }
}

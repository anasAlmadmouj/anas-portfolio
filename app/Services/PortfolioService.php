<?php

namespace App\Services;

use App\DataTransferObjects\ExperienceData;
use App\DataTransferObjects\ProjectData;
use App\DataTransferObjects\ServiceData;
use App\DataTransferObjects\SkillGroupData;
use Illuminate\Support\Collection;

class PortfolioService
{
    /**
     * @return Collection<int, ProjectData>
     */
    public function projects(): Collection
    {
        return collect(config('portfolio.projects', []))
            ->filter(fn (array $project) => $project['is_public'] ?? true)
            ->map(fn (array $project) => ProjectData::fromConfig($project))
            ->values();
    }

    /**
     * @return Collection<int, ProjectData>
     */
    public function featuredProjects(): Collection
    {
        return $this->projects()->filter->isFeatured->values();
    }

    public function project(string $slug): ?ProjectData
    {
        return $this->projects()->first(fn (ProjectData $project) => $project->slug === $slug);
    }

    /**
     * @return Collection<int, ExperienceData>
     */
    public function experience(): Collection
    {
        return collect(config('portfolio.experience', []))
            ->map(fn (array $item) => ExperienceData::fromConfig($item))
            ->values();
    }

    /**
     * @return Collection<int, SkillGroupData>
     */
    public function skillGroups(): Collection
    {
        return collect(config('portfolio.skills', []))
            ->map(fn (array $group) => SkillGroupData::fromConfig($group))
            ->values();
    }

    /**
     * @return Collection<int, ServiceData>
     */
    public function services(): Collection
    {
        return collect(config('portfolio.services', []))
            ->map(fn (array $service) => ServiceData::fromConfig($service))
            ->values();
    }
}

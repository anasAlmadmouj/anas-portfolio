<?php

namespace App\Http\Controllers;

use App\Services\PortfolioService;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class SitemapController extends Controller
{
    public function __construct(private readonly PortfolioService $portfolio) {}

    public function index(): Response
    {
        $pages = collect([
            ['name' => 'home', 'params' => []],
            ['name' => 'projects.index', 'params' => []],
        ])->concat(
            $this->portfolio->projects()->map(fn ($project) => [
                'name' => 'projects.show',
                'params' => ['slug' => $project->slug],
            ])
        );

        $entries = $this->buildLocalizedEntries($pages);

        return response()
            ->view('sitemap', ['entries' => $entries])
            ->header('Content-Type', 'text/xml');
    }

    /**
     * @return Collection<int, array{en: string, ar: string}>
     */
    private function buildLocalizedEntries(Collection $pages): Collection
    {
        return $pages->map(fn (array $page) => [
            'en' => route($page['name'], [...$page['params'], 'locale' => 'en']),
            'ar' => route($page['name'], [...$page['params'], 'locale' => 'ar']),
        ]);
    }
}

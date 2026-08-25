<?php

namespace App\Http\Controllers;

use App\Services\PortfolioService;
use Illuminate\Contracts\View\View;

class ProjectController extends Controller
{
    public function __construct(private readonly PortfolioService $portfolio) {}

    public function index(): View
    {
        return view('pages.projects', [
            'projects' => $this->portfolio->projects(),
        ]);
    }

    public function show(string $locale, string $slug): View
    {
        $project = $this->portfolio->project($slug);

        abort_if($project === null, 404);

        return view('pages.project-details', [
            'project' => $project,
        ]);
    }
}

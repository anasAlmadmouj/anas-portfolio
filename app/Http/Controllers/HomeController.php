<?php

namespace App\Http\Controllers;

use App\Services\PortfolioService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    public function __construct(private readonly PortfolioService $portfolio) {}

    public function index(): View
    {
        return view('pages.home', [
            'featuredProjects' => $this->portfolio->featuredProjects(),
            'experience' => $this->portfolio->experience(),
            'skillGroups' => $this->portfolio->skillGroups(),
            'services' => $this->portfolio->services(),
            'hasCv' => File::exists(public_path(config('portfolio.cv_path'))),
        ]);
    }
}

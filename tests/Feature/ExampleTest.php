<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_root_redirects_to_the_preferred_locale(): void
    {
        $response = $this->get('/');

        $response->assertRedirect('/en');
    }

    public function test_the_english_homepage_returns_a_successful_response(): void
    {
        $response = $this->get('/en');

        $response->assertStatus(200);
    }

    public function test_the_arabic_homepage_returns_a_successful_response(): void
    {
        $response = $this->get('/ar');

        $response->assertStatus(200);
    }

    public function test_navbar_contains_all_navigation_items_and_status(): void
    {
        $response = $this->get('/en');

        $response->assertStatus(200);
        $response->assertSee('navbar', false);
        $response->assertSee('data-navbar', false);
        $response->assertSee('data-nav-indicator', false);
        $response->assertSee('data-mobile-menu', false);
        $response->assertSee('Available for New Opportunities');
        $response->assertSee('http://localhost/ar', false);
    }

    public function test_language_switcher_preserves_internal_page_routes(): void
    {
        $response = $this->get('/en/projects/tourstify');

        $response->assertStatus(200);
        $response->assertSee('href="http://localhost/ar/projects/tourstify"', false);
    }
}

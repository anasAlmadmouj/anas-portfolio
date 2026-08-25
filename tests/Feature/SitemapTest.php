<?php

namespace Tests\Feature;

use Tests\TestCase;

class SitemapTest extends TestCase
{
    public function test_sitemap_is_reachable_with_the_correct_content_type(): void
    {
        $response = $this->get('/sitemap.xml');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/xml; charset=UTF-8');
    }

    public function test_sitemap_lists_both_locales_for_public_pages(): void
    {
        $response = $this->get('/sitemap.xml');

        $response->assertSee('http://localhost/en', false);
        $response->assertSee('http://localhost/ar', false);
        $response->assertSee('http://localhost/en/projects/tourstify', false);
    }

    public function test_sitemap_excludes_non_public_projects(): void
    {
        $response = $this->get('/sitemap.xml');

        $response->assertDontSee('internal-tool-nda');
    }
}

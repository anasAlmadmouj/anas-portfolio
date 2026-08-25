<?php

namespace Tests\Feature;

use Tests\TestCase;

class SeoTest extends TestCase
{
    public function test_homepage_has_a_canonical_link(): void
    {
        $response = $this->get('/en');

        $response->assertSee('rel="canonical" href="http://localhost/en"', false);
    }

    public function test_homepage_has_hreflang_alternates_for_both_locales(): void
    {
        $response = $this->get('/en');

        $response->assertSee('hreflang="en"', false);
        $response->assertSee('hreflang="ar"', false);
        $response->assertSee('hreflang="x-default"', false);
    }

    public function test_homepage_has_open_graph_and_twitter_metadata(): void
    {
        $response = $this->get('/en');

        $response->assertSee('property="og:title"', false);
        $response->assertSee('property="og:description"', false);
        $response->assertSee('property="og:type" content="website"', false);
        $response->assertSee('name="twitter:card"', false);
    }

    public function test_homepage_has_valid_person_json_ld(): void
    {
        $response = $this->get('/en');

        preg_match('#<script type="application/ld\+json">(.*?)</script>#s', $response->getContent(), $matches);

        $this->assertNotEmpty($matches);

        $data = json_decode($matches[1], true);

        $this->assertSame('https://schema.org', $data['@context']);
        $this->assertSame('Person', $data['@type']);
        $this->assertSame('Anas Almadmouj', $data['name']);
    }

    public function test_a_completely_unmatched_url_still_renders_the_custom_404_page(): void
    {
        $response = $this->get('/this-route-does-not-exist-anywhere');

        $response->assertStatus(404);
        $response->assertSee('This route doesn&#039;t exist.', false);
    }

    public function test_an_unmatched_path_under_a_valid_locale_keeps_that_locale_on_the_404_page(): void
    {
        $response = $this->get('/ar/this-route-does-not-exist-anywhere');

        $response->assertStatus(404);
        $response->assertSee('lang="ar" dir="rtl"', false);
        $response->assertSee('هذا المسار غير موجود', false);
    }
}

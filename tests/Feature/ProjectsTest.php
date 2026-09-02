<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProjectsTest extends TestCase
{
    public function test_projects_index_returns_a_successful_response(): void
    {
        $response = $this->get('/en/projects');

        $response->assertStatus(200);
    }

    public function test_tourstify_project_details_page_is_reachable_with_screenshots(): void
    {
        $response = $this->get('/en/projects/tourstify');

        $response->assertStatus(200);
        $response->assertSee('Tourstify');
        $response->assertSee('images/projects/tourstify/1.jpeg');
    }

    public function test_mondoway_project_details_page_is_reachable_with_screenshots(): void
    {
        $response = $this->get('/en/projects/mondoway');

        $response->assertStatus(200);
        $response->assertSee('MondoWay');
        $response->assertSee('images/projects/mondoway/1.jpeg');
    }

    public function test_bravobravo_project_details_page_is_reachable_with_screenshots(): void
    {
        $response = $this->get('/en/projects/bravobravo');

        $response->assertStatus(200);
        $response->assertSee('BravoBravo');
        $response->assertSee('images/projects/bravobravo/1.jpeg');
    }

    public function test_ahlan_project_details_page_is_reachable_with_screenshots(): void
    {
        $response = $this->get('/en/projects/ahlan');

        $response->assertStatus(200);
        $response->assertSee('Ahlan');
        $response->assertSee('images/projects/ahlan/1.jpeg');
    }

    public function test_an_unknown_project_slug_returns_a_404(): void
    {
        $response = $this->get('/en/projects/does-not-exist');

        $response->assertStatus(404);
    }
}

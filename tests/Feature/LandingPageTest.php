<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LandingPageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_landing_page_loads_correctly()
    {
        // Request the landing page
        $response = $this->get('/');

        // Assert the status is 200 (OK)
        $response->assertStatus(200);

        // Assert that the page contains the specific text
        $response->assertSee('Channel Serbades');
        $response->assertSee('Subscribe');

        // Assert that the page contains the YouTube icon
        $response->assertSee('<img src="' . asset('assets/icon/youtube.svg') . '"', false);
    }
}

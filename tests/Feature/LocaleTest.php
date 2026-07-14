<?php

namespace Tests\Feature;

use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LocaleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware(ValidateCsrfToken::class);
    }

    public function test_language_toggle_switches_to_amharic(): void
    {
        $this->get('/');

        $response = $this->post(route('locale.toggle'), [], [
            'Accept' => 'application/json',
        ]);

        $response->assertOk()
            ->assertJson(['locale' => 'am']);

        $this->assertEquals('am', session('locale'));
    }

    public function test_amharic_locale_shows_translated_navigation(): void
    {
        session(['locale' => 'am']);

        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('አገልግሎቶች', false)
            ->assertSee('አግኙን', false);
    }

    public function test_amharic_locale_shows_cms_translated_hero(): void
    {
        $this->seed();

        session(['locale' => 'am']);

        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('ለመዝገብዎ ግልጽነት እና ማመን', false);
    }

    public function test_toggle_returns_to_english(): void
    {
        session(['locale' => 'am']);

        $response = $this->post(route('locale.toggle'), [], [
            'Accept' => 'application/json',
        ]);

        $response->assertOk()
            ->assertJson(['locale' => 'en']);
    }

    public function test_language_toggle_is_present_in_header(): void
    {
        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('lang-toggle', false)
            ->assertSee('EN', false)
            ->assertSee('አማ', false);
    }
}

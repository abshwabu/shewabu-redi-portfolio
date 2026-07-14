<?php

namespace Tests\Feature;

use App\Enums\ContentStatus;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use App\Models\Testimonial;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        SiteSetting::current()->update([
            'hero_heading' => 'Test hero',
            'hero_subheading' => 'Hero sub',
            'about_excerpt' => 'About excerpt',
            'mission' => 'Mission text',
            'vision' => 'Vision text',
            'stat_years_value' => '10+',
            'stat_years_label' => 'Years',
        ]);

        Service::query()->create([
            'title' => 'Tax Advisory',
            'summary' => 'Tax help',
            'body' => '<p>Full tax body</p>',
            'category' => 'Tax',
            'is_featured' => true,
            'status' => ContentStatus::Published,
            'sort_order' => 1,
        ]);

        Service::query()->create([
            'title' => 'Bookkeeping',
            'summary' => 'Books help',
            'body' => '<p>Books body</p>',
            'category' => 'Accounting',
            'is_featured' => true,
            'status' => ContentStatus::Published,
            'sort_order' => 2,
        ]);

        TeamMember::query()->create([
            'name' => 'Ada Partner',
            'role' => 'Partner',
            'status' => ContentStatus::Published,
            'sort_order' => 1,
        ]);

        Testimonial::query()->create([
            'client_name' => 'Client One',
            'quote' => 'Great firm.',
            'is_featured' => true,
            'status' => ContentStatus::Published,
            'sort_order' => 1,
        ]);
    }

    public function test_home_renders_dynamic_sections(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Test hero')
            ->assertSee('Tax Advisory')
            ->assertSee('Why Choose Us')
            ->assertSee('10+')
            ->assertSee('Great firm.')
            ->assertSee('Ready for clearer books');
    }

    public function test_about_renders_story_mission_and_team(): void
    {
        $this->get('/about')
            ->assertOk()
            ->assertSee('About excerpt')
            ->assertSee('Mission text')
            ->assertSee('Vision text')
            ->assertSee('Ada Partner')
            ->assertSee(route('team'), false);
    }

    public function test_services_index_and_detail(): void
    {
        $this->get('/services')
            ->assertOk()
            ->assertSee('Tax Advisory')
            ->assertSee('Bookkeeping');

        $this->get('/services/tax-advisory')
            ->assertOk()
            ->assertSee('Full tax body')
            ->assertSee('Related services')
            ->assertSee('Bookkeeping')
            ->assertSee(route('contact'), false);
    }
}

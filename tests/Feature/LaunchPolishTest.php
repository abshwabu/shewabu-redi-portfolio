<?php

namespace Tests\Feature;

use App\Enums\ContentStatus;
use App\Models\Post;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LaunchPolishTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        SiteSetting::current()->update([
            'firm_name' => 'Shewabu Redi Mohammed Authorized Accounting Firm',
            'seo_title' => 'Default SEO Title',
            'seo_description' => 'Default SEO description for the firm.',
            'seo_keywords' => 'audit, tax, accounting',
            'privacy_body' => '<p>Privacy policy content.</p>',
            'terms_body' => '<p>Terms of use content.</p>',
            'industries_heading' => 'Industries',
            'industries_body' => '<p>Industry sectors we serve.</p>',
        ]);
    }

    public function test_sitemap_returns_xml_with_published_urls(): void
    {
        Service::query()->create([
            'title' => 'Tax Advisory',
            'summary' => 'Tax help',
            'body' => '<p>Body</p>',
            'status' => ContentStatus::Published,
            'sort_order' => 1,
        ]);

        TeamMember::query()->create([
            'name' => 'Ada Partner',
            'role' => 'Partner',
            'status' => ContentStatus::Published,
            'sort_order' => 1,
        ]);

        $response = $this->get('/sitemap.xml');

        $response
            ->assertOk()
            ->assertHeader('content-type', 'application/xml; charset=UTF-8')
            ->assertSee('<urlset', false)
            ->assertSee(route('home'), false)
            ->assertSee('/services/tax-advisory', false)
            ->assertSee('/team/ada-partner', false);
    }

    public function test_service_page_renders_open_graph_tags(): void
    {
        Service::query()->create([
            'title' => 'Audit Services',
            'summary' => 'Audit summary text',
            'body' => '<p>Audit body</p>',
            'meta_title' => 'Custom Audit Title',
            'meta_description' => 'Custom audit meta',
            'status' => ContentStatus::Published,
            'sort_order' => 1,
        ]);

        $this->get('/services/audit-services')
            ->assertOk()
            ->assertSee('<meta property="og:title" content="Custom Audit Title">', false)
            ->assertSee('<meta property="og:description" content="Custom audit meta">', false)
            ->assertSee('<meta property="og:type" content="article">', false)
            ->assertSee('<link rel="canonical"', false);
    }

    public function test_404_page_is_styled(): void
    {
        $this->get('/does-not-exist')
            ->assertNotFound()
            ->assertSee('Page not found')
            ->assertSee(route('home'), false)
            ->assertSee(route('contact'), false);
    }

    public function test_privacy_and_industries_use_cms_content(): void
    {
        $this->get('/privacy')
            ->assertOk()
            ->assertSee('Privacy policy content')
            ->assertDontSee('Page content will be added');

        $this->get('/terms')
            ->assertOk()
            ->assertSee('Terms of use content')
            ->assertDontSee('Page content will be added');

        $this->get('/industries')
            ->assertOk()
            ->assertSee('Industry sectors we serve')
            ->assertDontSee('Page content will be added');
    }

    public function test_images_include_lazy_loading_and_alt_text(): void
    {
        Service::query()->create([
            'title' => 'Tax Advisory',
            'summary' => 'Tax help',
            'body' => '<p>Body</p>',
            'image' => 'services/tax.jpg',
            'status' => ContentStatus::Published,
            'sort_order' => 1,
        ]);

        $this->get('/services')
            ->assertOk()
            ->assertSee('loading="lazy"', false)
            ->assertSee('alt="Tax Advisory"', false);
    }
}

<?php

namespace Tests\Feature;

use App\Enums\ContentStatus;
use App\Enums\PostStatus;
use App\Models\ContactSubmission;
use App\Models\Faq;
use App\Models\Post;
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
            'phone' => '+251 11 000 0000',
            'email' => 'info@example.com',
            'address' => 'Test Street',
            'city' => 'Addis Ababa',
            'country' => 'Ethiopia',
            'office_hours' => 'Mon–Fri, 9 AM – 5 PM',
            'map_embed_url' => 'https://www.google.com/maps/embed?pb=test',
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
            'bio' => '<p>Ada leads client engagements.</p>',
            'email' => 'ada@example.com',
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
            ->assertSee(route('team.index'), false);
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

    public function test_team_index_and_detail(): void
    {
        $member = TeamMember::query()->firstOrFail();

        $this->get('/team')
            ->assertOk()
            ->assertSee('Ada Partner')
            ->assertSee('Partner');

        $this->get('/team/'.$member->slug)
            ->assertOk()
            ->assertSee('Ada leads client engagements')
            ->assertSee('ada@example.com');
    }

    public function test_about_team_redirects_to_team(): void
    {
        $this->get('/about/team')
            ->assertRedirect('/team');
    }

    public function test_insights_index_and_detail(): void
    {
        $author = TeamMember::query()->firstOrFail();

        $post = Post::query()->create([
            'team_member_id' => $author->id,
            'title' => 'Year-end tax checklist',
            'excerpt' => 'Prepare before filing season.',
            'body' => '<p>Review withholdings and deductions.</p>',
            'category' => 'Tax Tips',
            'status' => PostStatus::Published,
            'published_at' => now()->subDay(),
        ]);

        Post::query()->create([
            'team_member_id' => $author->id,
            'title' => 'Audit planning basics',
            'excerpt' => 'What to expect in fieldwork.',
            'body' => '<p>Schedules and evidence packs matter.</p>',
            'category' => 'Compliance',
            'status' => PostStatus::Published,
            'published_at' => now()->subDays(3),
        ]);

        $this->get('/insights')
            ->assertOk()
            ->assertSee('Year-end tax checklist')
            ->assertSee('Tax Tips');

        $this->get('/insights/'.$post->slug)
            ->assertOk()
            ->assertSee('Review withholdings and deductions')
            ->assertSee('Ada Partner')
            ->assertSee(route('team.show', $author), false)
            ->assertSee('Related insights');
    }

    public function test_faq_page_renders_grouped_accordion(): void
    {
        Faq::query()->create([
            'question' => 'Are you authorized?',
            'answer' => '<p>Yes, we are an authorized firm.</p>',
            'category' => 'General',
            'status' => ContentStatus::Published,
            'sort_order' => 1,
        ]);

        Faq::query()->create([
            'question' => 'How are fees structured?',
            'answer' => '<p>Fees depend on scope.</p>',
            'category' => 'Pricing',
            'status' => ContentStatus::Published,
            'sort_order' => 2,
        ]);

        $this->get('/faq')
            ->assertOk()
            ->assertSee('Are you authorized?')
            ->assertSee('How are fees structured?')
            ->assertSee('General')
            ->assertSee('Pricing');
    }

    public function test_contact_page_renders_form_and_office_info(): void
    {
        $this->get('/contact')
            ->assertOk()
            ->assertSee('Send a message')
            ->assertSee('info@example.com')
            ->assertSee('Mon–Fri, 9 AM – 5 PM')
            ->assertSee('https://www.google.com/maps/embed?pb=test', false);
    }

    public function test_contact_form_creates_submission(): void
    {
        $this->postJson('/contact', [
            'name' => 'Jane Client',
            'email' => 'jane@example.com',
            'phone' => '+251 91 000 0000',
            'subject' => 'Tax advisory',
            'message' => 'We need help with year-end filing.',
        ])
            ->assertOk()
            ->assertJson(['message' => 'Thank you for your message. We will respond shortly.']);

        $this->assertDatabaseHas('contact_submissions', [
            'email' => 'jane@example.com',
            'subject' => 'Tax advisory',
        ]);
    }

    public function test_contact_form_validates_required_fields(): void
    {
        $this->postJson('/contact', [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'email', 'message']);

        $this->assertSame(0, ContactSubmission::query()->count());
    }
}

<?php

namespace Tests\Feature;

use App\Enums\ContactSubmissionStatus;
use App\Enums\ContentStatus;
use App\Enums\PostStatus;
use App\Filament\Pages\ManageSettings;
use App\Filament\Resources\ContactSubmissionResource\Pages\EditContactSubmission;
use App\Filament\Resources\ContactSubmissionResource\Pages\ListContactSubmissions;
use App\Filament\Resources\FaqResource\Pages\CreateFaq;
use App\Filament\Resources\FaqResource\Pages\EditFaq;
use App\Filament\Resources\FaqResource\Pages\ListFaqs;
use App\Filament\Resources\PostResource\Pages\CreatePost;
use App\Filament\Resources\PostResource\Pages\EditPost;
use App\Filament\Resources\PostResource\Pages\ListPosts;
use App\Filament\Resources\ServiceResource\Pages\CreateService;
use App\Filament\Resources\ServiceResource\Pages\EditService;
use App\Filament\Resources\ServiceResource\Pages\ListServices;
use App\Filament\Resources\TeamMemberResource\Pages\CreateTeamMember;
use App\Filament\Resources\TeamMemberResource\Pages\EditTeamMember;
use App\Filament\Resources\TeamMemberResource\Pages\ListTeamMembers;
use App\Filament\Resources\TestimonialResource\Pages\CreateTestimonial;
use App\Filament\Resources\TestimonialResource\Pages\EditTestimonial;
use App\Filament\Resources\TestimonialResource\Pages\ListTestimonials;
use App\Models\ContactSubmission;
use App\Models\Faq;
use App\Models\Post;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class FilamentDataLayerTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($this->admin);
    }

    public function test_service_crud(): void
    {
        Livewire::test(ListServices::class)->assertSuccessful();

        Livewire::test(CreateService::class)
            ->fillForm([
                'title' => 'Internal Controls Review',
                'slug' => 'internal-controls-review',
                'summary' => 'Assessment of internal control systems.',
                'body' => '<p>Detailed control review engagement.</p>',
                'category' => 'Compliance',
                'status' => ContentStatus::Published->value,
                'is_featured' => true,
                'sort_order' => 10,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('services', [
            'title' => 'Internal Controls Review',
            'slug' => 'internal-controls-review',
        ]);

        $service = Service::query()->where('slug', 'internal-controls-review')->firstOrFail();

        Livewire::test(EditService::class, ['record' => $service->getRouteKey()])
            ->fillForm([
                'title' => 'Internal Controls Assessment',
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'title' => 'Internal Controls Assessment',
        ]);

        $service->delete();
        $this->assertDatabaseMissing('services', ['id' => $service->id]);
    }

    public function test_team_member_crud_and_slug_from_name(): void
    {
        Livewire::test(ListTeamMembers::class)->assertSuccessful();

        Livewire::test(CreateTeamMember::class)
            ->fillForm([
                'name' => 'Michael Alemu',
                'role' => 'Senior Auditor',
                'bio' => '<p>Experienced auditor.</p>',
                'status' => ContentStatus::Published->value,
                'is_featured' => false,
                'sort_order' => 5,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $member = TeamMember::query()->where('name', 'Michael Alemu')->firstOrFail();
        $this->assertSame('michael-alemu', $member->slug);

        Livewire::test(EditTeamMember::class, ['record' => $member->getRouteKey()])
            ->fillForm(['role' => 'Audit Supervisor'])
            ->call('save')
            ->assertHasNoFormErrors();

        $member->delete();
        $this->assertDatabaseMissing('team_members', ['id' => $member->id]);
    }

    public function test_testimonial_crud(): void
    {
        Livewire::test(ListTestimonials::class)->assertSuccessful();

        Livewire::test(CreateTestimonial::class)
            ->fillForm([
                'client_name' => 'Helen Desta',
                'client_role' => 'CFO',
                'company' => 'Blue Nile Foods',
                'quote' => 'Excellent payroll and tax support.',
                'rating' => 5,
                'status' => ContentStatus::Published->value,
                'is_featured' => true,
                'sort_order' => 1,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $testimonial = Testimonial::query()->where('client_name', 'Helen Desta')->firstOrFail();

        Livewire::test(EditTestimonial::class, ['record' => $testimonial->getRouteKey()])
            ->fillForm(['quote' => 'Outstanding advisory partnership.'])
            ->call('save')
            ->assertHasNoFormErrors();

        $testimonial->delete();
        $this->assertDatabaseMissing('testimonials', ['id' => $testimonial->id]);
    }

    public function test_post_crud_with_author_relationship(): void
    {
        $author = TeamMember::query()->create([
            'name' => 'Author Person',
            'role' => 'Partner',
            'status' => ContentStatus::Published,
            'sort_order' => 1,
        ]);

        Livewire::test(ListPosts::class)->assertSuccessful();

        Livewire::test(CreatePost::class)
            ->fillForm([
                'title' => 'Understanding VAT for retailers',
                'slug' => 'understanding-vat-for-retailers',
                'team_member_id' => $author->id,
                'excerpt' => 'VAT basics for retail businesses.',
                'body' => '<p>Retailers should track input and output VAT carefully.</p>',
                'category' => 'Tax Tips',
                'status' => PostStatus::Published->value,
                'published_at' => now()->toDateTimeString(),
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $post = Post::query()->where('slug', 'understanding-vat-for-retailers')->firstOrFail();
        $this->assertTrue($post->author->is($author));

        Livewire::test(EditPost::class, ['record' => $post->getRouteKey()])
            ->fillForm(['title' => 'VAT essentials for retailers'])
            ->call('save')
            ->assertHasNoFormErrors();

        $post->delete();
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }

    public function test_faq_crud(): void
    {
        Livewire::test(ListFaqs::class)->assertSuccessful();

        Livewire::test(CreateFaq::class)
            ->fillForm([
                'question' => 'Do you offer remote engagements?',
                'answer' => '<p>Yes, many advisory and bookkeeping engagements are delivered remotely.</p>',
                'category' => 'General',
                'status' => ContentStatus::Published->value,
                'sort_order' => 1,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $faq = Faq::query()->where('question', 'Do you offer remote engagements?')->firstOrFail();

        Livewire::test(EditFaq::class, ['record' => $faq->getRouteKey()])
            ->fillForm(['sort_order' => 2])
            ->call('save')
            ->assertHasNoFormErrors();

        $faq->delete();
        $this->assertDatabaseMissing('faqs', ['id' => $faq->id]);
    }

    public function test_contact_submission_is_read_only_except_status(): void
    {
        $submission = ContactSubmission::query()->create([
            'name' => 'Visitor',
            'email' => 'visitor@example.com',
            'subject' => 'Hello',
            'message' => 'Please call me back.',
            'status' => ContactSubmissionStatus::New,
        ]);

        Livewire::test(ListContactSubmissions::class)->assertSuccessful();

        Livewire::test(ListContactSubmissions::class)
            ->callTableAction('markAsRead', $submission);

        $this->assertSame(ContactSubmissionStatus::Read, $submission->fresh()->status);
        $this->assertNotNull($submission->fresh()->read_at);

        Livewire::test(EditContactSubmission::class, ['record' => $submission->getRouteKey()])
            ->assertFormFieldIsDisabled('name')
            ->assertFormFieldIsDisabled('email')
            ->assertFormFieldIsDisabled('message')
            ->fillForm([
                'status' => ContactSubmissionStatus::Replied->value,
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertSame(ContactSubmissionStatus::Replied, $submission->fresh()->status);
    }

    public function test_settings_page_saves(): void
    {
        Livewire::test(ManageSettings::class)
            ->assertSuccessful()
            ->fillForm([
                'firm_name' => 'Shewabu Redi Mohammed Authorized Accounting Firm',
                'email' => 'hello@shewaburedi.com',
                'hero_heading' => 'Updated hero',
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('site_settings', [
            'email' => 'hello@shewaburedi.com',
            'hero_heading' => 'Updated hero',
        ]);

        $this->assertSame(1, SiteSetting::query()->count());
    }
}

<?php

namespace Database\Seeders;

use App\Enums\ContactSubmissionStatus;
use App\Enums\ContentStatus;
use App\Enums\PostStatus;
use App\Models\ContactSubmission;
use App\Models\Faq;
use App\Models\Post;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@shewaburedi.com'],
            [
                'name' => 'Firm Administrator',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        $this->seedSettings();
        $team = $this->seedTeamMembers();
        $this->seedServices();
        $this->seedTestimonials();
        $this->seedPosts($team);
        $this->seedFaqs();
        $this->seedContactSubmissions();
    }

    protected function seedSettings(): void
    {
        SiteSetting::current()->update([
            'firm_name' => 'Shewabu Redi Mohammed Authorized Accounting Firm',
            'tagline' => 'Trusted audit, tax, and advisory services',
            'phone' => '+251 11 123 4567',
            'email' => 'info@shewaburedi.com',
            'address' => 'Bole Road, near Atlas Hotel',
            'city' => 'Addis Ababa',
            'country' => 'Ethiopia',
            'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3940.366489562!2d38.7578!3d8.9806!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zOMKwNTgnNTAuMiJOIDM4wrA0NScyOC4xIkU!5e0!3m2!1sen!2set!4v1',
            'office_hours' => 'Mon–Fri, 8:30 AM – 5:30 PM',
            'hero_heading' => 'Clarity and confidence for your books',
            'hero_subheading' => 'Shewabu Redi Mohammed Authorized Accounting Firm supports businesses and organizations with audit, tax, bookkeeping, and advisory services delivered to professional standards.',
            'hero_cta_label' => 'Book a consultation',
            'hero_cta_url' => '/contact',
            'about_excerpt' => 'We are an authorized accounting firm serving clients across Ethiopia with integrity, regulatory excellence, and practical financial guidance. Our engagement approach balances technical precision with clear communication so leaders can make decisions with confidence.',
            'mission' => 'To deliver dependable audit, tax, and advisory services that strengthen financial integrity and help Ethiopian organizations meet their obligations and ambitions.',
            'vision' => 'To be the trusted authorized accounting partner known for clarity, ethical practice, and lasting client relationships.',
            'stat_years_value' => '15+',
            'stat_years_label' => 'Years of experience',
            'stat_clients_value' => '200+',
            'stat_clients_label' => 'Clients served',
            'stat_engagements_value' => '500+',
            'stat_engagements_label' => 'Engagements completed',
            'stat_professionals_value' => '12',
            'stat_professionals_label' => 'Qualified professionals',
            'linkedin_url' => 'https://www.linkedin.com/',
            'facebook_url' => 'https://www.facebook.com/',
            'twitter_url' => 'https://x.com/',
            'seo_title' => 'Shewabu Redi Mohammed Authorized Accounting Firm',
            'seo_description' => 'Professional audit, taxation, bookkeeping, payroll, and business advisory services in Addis Ababa, Ethiopia.',
            'seo_keywords' => 'accounting firm, audit, tax advisory, bookkeeping, Addis Ababa',
            'industries_heading' => 'Industries we serve',
            'industries_intro' => 'Sector experience across trading, professional services, NGOs, and growing enterprises in Ethiopia.',
            'industries_body' => '<p>We support clients in retail and distribution, manufacturing, professional services, hospitality, construction, and non-profit organizations. Our teams adapt audit, tax, and accounting approaches to sector-specific reporting cycles and regulatory expectations.</p><ul><li><strong>Trading &amp; distribution</strong> — inventory, VAT, and working-capital reporting.</li><li><strong>Professional services</strong> — partner remuneration, WHT, and engagement profitability.</li><li><strong>NGOs &amp; associations</strong> — grant accounting and donor reporting.</li><li><strong>Growing SMEs</strong> — scalable bookkeeping and filing discipline.</li></ul>',
            'privacy_body' => '<p>Shewabu Redi Mohammed Authorized Accounting Firm respects your privacy. Information submitted through our website contact form is used only to respond to your enquiry and manage our professional relationship. We do not sell personal data.</p><p>We retain contact submissions for as long as needed to handle your request and meet professional record-keeping obligations. You may request access to or correction of your personal information by emailing us at info@shewaburedi.com.</p>',
            'terms_body' => '<p>This website provides general information about our firm and services. It does not constitute professional advice. Engagements are governed by separate engagement letters agreed with clients.</p><p>Content on this site may be updated without notice. By using this website you agree not to misuse forms, attempt unauthorized access, or reproduce materials without permission.</p>',
            'home_cta_heading' => 'Ready for clearer books and stronger compliance?',
            'home_cta_body' => 'Tell us about your filing calendar, audit needs, or growth plans — we will respond with a focused next step.',
        ]);
    }

    /**
     * @return array<int, TeamMember>
     */
    protected function seedTeamMembers(): array
    {
        $members = [
            [
                'name' => 'Shewabu Redi Mohammed',
                'role' => 'Managing Partner',
                'bio' => '<p>Founder and managing partner with extensive experience in statutory audit, tax compliance, and financial advisory for Ethiopian enterprises.</p>',
                'email' => 'shewabu@shewaburedi.com',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Sara Bekele',
                'role' => 'Tax Manager',
                'bio' => '<p>Leads corporate and personal tax engagements, with deep knowledge of Ethiopian Revenue Authority procedures and planning strategies.</p>',
                'email' => 'sara@shewaburedi.com',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Daniel Hailu',
                'role' => 'Audit Manager',
                'bio' => '<p>Oversees external audit assignments for SMEs and NGOs, ensuring quality control and ISA-aligned deliverables.</p>',
                'email' => 'daniel@shewaburedi.com',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Hanna Tadesse',
                'role' => 'Senior Accountant',
                'bio' => '<p>Supports clients with bookkeeping, payroll, and month-end reporting using modern accounting systems.</p>',
                'email' => 'hanna@shewaburedi.com',
                'is_featured' => false,
                'sort_order' => 4,
            ],
        ];

        $created = [];

        foreach ($members as $member) {
            $created[] = TeamMember::query()->updateOrCreate(
                ['email' => $member['email']],
                array_merge($member, [
                    'status' => ContentStatus::Published,
                    'phone' => '+251 91 000 000'.($member['sort_order']),
                    'linkedin_url' => 'https://www.linkedin.com/',
                ])
            );
        }

        return $created;
    }

    protected function seedServices(): void
    {
        $services = [
            [
                'title' => 'Tax Advisory',
                'summary' => 'Corporate and personal tax planning, filing, and representation before tax authorities.',
                'body' => '<p>We help clients stay compliant while identifying legitimate planning opportunities under Ethiopian tax law.</p><ul><li>Corporate income tax</li><li>VAT and withholding</li><li>Tax health checks</li></ul>',
                'category' => 'Tax',
                'icon' => 'heroicon-o-calculator',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Audit & Assurance',
                'summary' => 'Independent statutory and special-purpose audits that build stakeholder confidence.',
                'body' => '<p>Our audit team delivers risk-based engagements aligned with international auditing standards.</p>',
                'category' => 'Audit',
                'icon' => 'heroicon-o-clipboard-document-check',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Bookkeeping',
                'summary' => 'Accurate day-to-day accounting so leadership always has a clear financial picture.',
                'body' => '<p>From transaction coding to reconciled ledgers and management packs, we keep your books current.</p>',
                'category' => 'Accounting',
                'icon' => 'heroicon-o-book-open',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Payroll Management',
                'summary' => 'Reliable payroll processing, statutory contributions, and employee payslips.',
                'body' => '<p>We manage payroll cycles, pension and tax withholdings, and payroll reporting for growing teams.</p>',
                'category' => 'Accounting',
                'icon' => 'heroicon-o-banknotes',
                'is_featured' => false,
                'sort_order' => 4,
            ],
            [
                'title' => 'Financial Consulting',
                'summary' => 'Practical advisory for budgeting, cash flow, and growth decisions.',
                'body' => '<p>Engage us for forecasts, management reporting frameworks, and decision support for owners and boards.</p>',
                'category' => 'Advisory',
                'icon' => 'heroicon-o-chart-bar',
                'is_featured' => true,
                'sort_order' => 5,
            ],
            [
                'title' => 'Business Registration',
                'summary' => 'Support for company formation, licensing, and regulatory setup.',
                'body' => '<p>We guide entrepreneurs through trade registration, TIN setup, and first-year compliance milestones.</p>',
                'category' => 'Registration',
                'icon' => 'heroicon-o-building-office-2',
                'is_featured' => false,
                'sort_order' => 6,
            ],
        ];

        foreach ($services as $service) {
            Service::query()->updateOrCreate(
                ['title' => $service['title']],
                array_merge($service, [
                    'status' => ContentStatus::Published,
                    'meta_title' => $service['title'].' | Shewabu Redi',
                    'meta_description' => $service['summary'],
                ])
            );
        }
    }

    protected function seedTestimonials(): void
    {
        $items = [
            [
                'client_name' => 'Abebe Kebede',
                'client_role' => 'Managing Director',
                'company' => 'Nile Trading PLC',
                'quote' => 'Shewabu Redi’s audit team was thorough, clear, and always available. Our lenders appreciated the quality of the report.',
                'rating' => 5,
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'client_name' => 'Meron Assefa',
                'client_role' => 'Finance Lead',
                'company' => 'Horizon NGOs Consortium',
                'quote' => 'Their bookkeeping and donor reporting support freed our internal team to focus on programme delivery.',
                'rating' => 5,
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'client_name' => 'Yonas Girma',
                'client_role' => 'Founder',
                'company' => 'Addis Tech Hub',
                'quote' => 'From company registration through first payroll, the firm guided us with practical steps and no surprises.',
                'rating' => 4,
                'is_featured' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($items as $item) {
            Testimonial::query()->updateOrCreate(
                ['client_name' => $item['client_name'], 'company' => $item['company']],
                array_merge($item, ['status' => ContentStatus::Published])
            );
        }
    }

    /**
     * @param  array<int, TeamMember>  $team
     */
    protected function seedPosts(array $team): void
    {
        $author = $team[1] ?? $team[0];

        $posts = [
            [
                'title' => 'Five tax checklist items before year-end',
                'excerpt' => 'A practical pre-filing checklist for Ethiopian SMEs preparing corporate income tax returns.',
                'body' => '<p>As the filing window approaches, review withholdings, deductible expenses, related-party transactions, VAT reconciliations, and documentation for fixed assets.</p><p>Our tax team can walk you through a short health check before you submit.</p>',
                'category' => 'Tax Tips',
                'status' => PostStatus::Published,
                'published_at' => now()->subDays(12),
            ],
            [
                'title' => 'What directors should expect from a statutory audit',
                'excerpt' => 'How audit planning, fieldwork, and management letters usually unfold for first-time auditees.',
                'body' => '<p>A clear timeline and prepared schedules speed fieldwork. We outline the evidence pack most boards need and how findings are communicated.</p>',
                'category' => 'Compliance',
                'status' => PostStatus::Published,
                'published_at' => now()->subDays(28),
            ],
            [
                'title' => 'Cash flow habits that keep growing firms solvent',
                'excerpt' => 'Simple reporting routines that help owners spot cash gaps early.',
                'body' => '<p>Weekly cash positions, aged receivables discipline, and a rolling 13-week forecast are foundations we recommend for growing companies.</p>',
                'category' => 'Business Advice',
                'status' => PostStatus::Published,
                'published_at' => now()->subDays(45),
            ],
        ];

        foreach ($posts as $post) {
            Post::query()->updateOrCreate(
                ['title' => $post['title']],
                array_merge($post, [
                    'team_member_id' => $author->id,
                    'meta_title' => $post['title'],
                    'meta_description' => $post['excerpt'],
                ])
            );
        }
    }

    protected function seedFaqs(): void
    {
        $faqs = [
            [
                'question' => 'Are you an authorized accounting firm in Ethiopia?',
                'answer' => '<p>Yes. Shewabu Redi Mohammed Authorized Accounting Firm operates as an authorized practice providing audit, tax, and accounting services.</p>',
                'category' => 'General',
                'sort_order' => 1,
            ],
            [
                'question' => 'Which clients do you typically work with?',
                'answer' => '<p>We serve SMEs, trading companies, professional service firms, and non-profits that need reliable compliance and advisory support.</p>',
                'category' => 'General',
                'sort_order' => 2,
            ],
            [
                'question' => 'How often should we engage tax advisory support?',
                'answer' => '<p>Most clients benefit from quarterly reviews plus filing-season support. Higher-growth companies often retain us year-round.</p>',
                'category' => 'Tax',
                'sort_order' => 3,
            ],
            [
                'question' => 'What does a typical audit engagement include?',
                'answer' => '<p>Planning, risk assessment, fieldwork, reporting, and a management letter with practical recommendations.</p>',
                'category' => 'Audit',
                'sort_order' => 4,
            ],
            [
                'question' => 'How are fees structured?',
                'answer' => '<p>Fees depend on scope, complexity, and reporting deadlines. We provide a written proposal before work begins.</p>',
                'category' => 'Pricing',
                'sort_order' => 5,
            ],
            [
                'question' => 'How do we start an engagement?',
                'answer' => '<p>Contact us with your needs. We schedule a discovery call, confirm scope, and issue an engagement letter.</p>',
                'category' => 'Engagement',
                'sort_order' => 6,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::query()->updateOrCreate(
                ['question' => $faq['question']],
                array_merge($faq, ['status' => ContentStatus::Published])
            );
        }
    }

    protected function seedContactSubmissions(): void
    {
        ContactSubmission::query()->updateOrCreate(
            ['email' => 'prospect@example.com', 'subject' => 'Request for tax consultation'],
            [
                'name' => 'Lidya Solomon',
                'phone' => '+251 92 111 2233',
                'message' => 'We would like to discuss corporate tax filing support for our trading company ahead of year-end.',
                'status' => ContactSubmissionStatus::New,
            ]
        );
    }
}

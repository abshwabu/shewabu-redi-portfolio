<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'firm_name',
        'tagline',
        'logo',
        'favicon',
        'phone',
        'email',
        'address',
        'city',
        'country',
        'map_embed_url',
        'hero_heading',
        'hero_subheading',
        'hero_cta_label',
        'hero_cta_url',
        'hero_image',
        'about_excerpt',
        'mission',
        'vision',
        'stat_years_label',
        'stat_years_value',
        'stat_clients_label',
        'stat_clients_value',
        'stat_engagements_label',
        'stat_engagements_value',
        'stat_professionals_label',
        'stat_professionals_value',
        'facebook_url',
        'linkedin_url',
        'twitter_url',
        'youtube_url',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'og_image',
    ];

    public static function current(): self
    {
        $settings = static::query()->first();

        if ($settings) {
            return $settings;
        }

        return static::query()->create([
            'firm_name' => 'Shewabu Redi Mohammed Authorized Accounting Firm',
            'tagline' => 'Authorized Accounting Firm',
        ]);
    }

    public function logoUrl(): ?string
    {
        return $this->publicUrl($this->logo);
    }

    public function heroImageUrl(): ?string
    {
        return $this->publicUrl($this->hero_image);
    }

    public function stats(): array
    {
        return collect([
            ['label' => $this->stat_years_label, 'value' => $this->stat_years_value],
            ['label' => $this->stat_clients_label, 'value' => $this->stat_clients_value],
            ['label' => $this->stat_engagements_label, 'value' => $this->stat_engagements_value],
            ['label' => $this->stat_professionals_label, 'value' => $this->stat_professionals_value],
        ])->filter(fn (array $stat) => filled($stat['label']) && filled($stat['value']))->values()->all();
    }

    protected function publicUrl(?string $path): ?string
    {
        if (blank($path)) {
            return null;
        }

        return Storage::disk('public')->url($path);
    }
}

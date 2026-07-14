<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}

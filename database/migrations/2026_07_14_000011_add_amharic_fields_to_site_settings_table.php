<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::table('site_settings', function (Blueprint $table) {
      $table->string('tagline_am')->nullable()->after('tagline');
      $table->string('hero_heading_am')->nullable()->after('hero_heading');
      $table->text('hero_subheading_am')->nullable()->after('hero_subheading');
      $table->string('hero_cta_label_am')->nullable()->after('hero_cta_label');
      $table->text('about_excerpt_am')->nullable()->after('about_excerpt');
      $table->text('mission_am')->nullable()->after('mission');
      $table->text('vision_am')->nullable()->after('vision');
      $table->string('home_cta_heading_am')->nullable()->after('home_cta_heading');
      $table->text('home_cta_body_am')->nullable()->after('home_cta_body');
      $table->string('industries_heading_am')->nullable()->after('industries_heading');
      $table->text('industries_intro_am')->nullable()->after('industries_intro');
      $table->text('industries_body_am')->nullable()->after('industries_body');
      $table->text('privacy_body_am')->nullable()->after('privacy_body');
      $table->text('terms_body_am')->nullable()->after('terms_body');
    });
  }

  public function down(): void
  {
    Schema::table('site_settings', function (Blueprint $table) {
      $table->dropColumn([
        'tagline_am',
        'hero_heading_am',
        'hero_subheading_am',
        'hero_cta_label_am',
        'about_excerpt_am',
        'mission_am',
        'vision_am',
        'home_cta_heading_am',
        'home_cta_body_am',
        'industries_heading_am',
        'industries_intro_am',
        'industries_body_am',
        'privacy_body_am',
        'terms_body_am',
      ]);
    });
  }
};

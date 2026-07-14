<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->text('privacy_body')->nullable()->after('og_image');
            $table->text('terms_body')->nullable()->after('privacy_body');
            $table->string('industries_heading')->nullable()->after('terms_body');
            $table->text('industries_intro')->nullable()->after('industries_heading');
            $table->text('industries_body')->nullable()->after('industries_intro');
            $table->string('home_cta_heading')->nullable()->after('industries_body');
            $table->text('home_cta_body')->nullable()->after('home_cta_heading');
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'privacy_body',
                'terms_body',
                'industries_heading',
                'industries_intro',
                'industries_body',
                'home_cta_heading',
                'home_cta_body',
            ]);
        });
    }
};

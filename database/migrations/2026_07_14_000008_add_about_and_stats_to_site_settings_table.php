<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->text('mission')->nullable()->after('about_excerpt');
            $table->text('vision')->nullable()->after('mission');
            $table->string('stat_years_label')->nullable()->after('vision');
            $table->string('stat_years_value')->nullable()->after('stat_years_label');
            $table->string('stat_clients_label')->nullable()->after('stat_years_value');
            $table->string('stat_clients_value')->nullable()->after('stat_clients_label');
            $table->string('stat_engagements_label')->nullable()->after('stat_clients_value');
            $table->string('stat_engagements_value')->nullable()->after('stat_engagements_label');
            $table->string('stat_professionals_label')->nullable()->after('stat_engagements_value');
            $table->string('stat_professionals_value')->nullable()->after('stat_professionals_label');
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
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
            ]);
        });
    }
};

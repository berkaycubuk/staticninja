<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('site_pages', function (Blueprint $table) {
            $table->string('title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_robots')->nullable()->default('index,follow');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_pages', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('meta_description');
            $table->dropColumn('meta_robots');
        });
    }
};

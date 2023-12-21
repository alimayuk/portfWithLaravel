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
        Schema::create('create_settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('footerText')->nullable();
            $table->string('aboutText')->nullable();
            $table->string('feature_cat_is_active')->default(1);
            $table->string('category_default_image')->nullable();
            $table->string('article_default_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('create_settings');
    }
};

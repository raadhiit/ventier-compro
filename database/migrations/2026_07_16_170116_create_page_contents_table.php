<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_contents', function (Blueprint $table) {
            $table->id();

            $table->string('page_key', 50);
            $table->string('section_key', 100);

            $table->string('title')->nullable();
            $table->text('subtitle')->nullable();
            $table->longText('content')->nullable();

            $table->string('image_path')->nullable();

            $table->string('cta_label')->nullable();
            $table->string('cta_url', 2048)->nullable();

            $table->json('settings')->nullable();

            $table->boolean('is_visible')->default(true);
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            $table->unique(
                ['page_key', 'section_key'],
                'page_contents_page_section_unique'
            );

            $table->index([
                'page_key',
                'is_visible',
                'sort_order',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_contents');
    }
};
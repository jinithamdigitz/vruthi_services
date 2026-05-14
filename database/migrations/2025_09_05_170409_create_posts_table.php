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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            // title and slug
            $table->string('title');
            $table->string('slug')->unique();

            // content
            $table->text('body')->nullable();

            // optional image path
            $table->string('image')->nullable();

            // link to category
            $table->foreignId('post_category_id')
                  ->constrained('post_categories')
                  ->cascadeOnDelete();

            // author (if you track users)
            $table->foreignId('user_id')->nullable()
                  ->constrained()
                  ->nullOnDelete();

            // status, tags, etc. can be added as needed
            $table->boolean('published')->default(false);

            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};

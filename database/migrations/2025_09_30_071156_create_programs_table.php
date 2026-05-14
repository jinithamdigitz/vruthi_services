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
        Schema::create('programs', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('name'); // Program Name
            $table->timestamp('created_date')->nullable(); // Created Date
            $table->text('description')->nullable(); // Description
            $table->string('image')->nullable(); // Image URL or path
            $table->string('video_id')->nullable(); // Video ID (YouTube, Vimeo, etc.)
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};

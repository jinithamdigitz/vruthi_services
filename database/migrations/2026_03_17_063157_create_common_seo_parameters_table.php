<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('common_seo_parameters', function (Blueprint $table) {
            $table->id();
            $table->string('keyword');
            $table->foreignId('post_id')
                ->constrained('seo_parameters')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('common_seo_parameters');
    }
};



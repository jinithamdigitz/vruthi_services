<?php
// database/migrations/xxxx_add_timestamps_to_common_seo_parameters_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('common_seo_parameters', function (Blueprint $table) {
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    public function down(): void
    {
        Schema::table('common_seo_parameters', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
};



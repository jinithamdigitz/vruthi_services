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
        Schema::table('enquiries', function (Blueprint $table) {
            // Make location nullable
            $table->string('location')->nullable()->change();
            
            // Make email nullable
            $table->string('email')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enquiries', function (Blueprint $table) {
            // Revert location to not nullable (you might need to set a default value)
            $table->string('location')->nullable(false)->change();
            
            // Revert email to not nullable
            $table->string('email')->nullable(false)->change();
        });
    }
};
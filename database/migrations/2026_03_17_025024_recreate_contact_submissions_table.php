<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Drop the old table if it exists
        Schema::dropIfExists('contact_submission');
        
        // Drop the new table if it exists (clean slate)
        Schema::dropIfExists('contact_submissions');
        
        // Create the new table with correct name
        Schema::create('contact_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('company')->nullable();
            $table->string('service_interest');
            $table->string('city');
            $table->text('project_description');
            $table->enum('status', ['pending', 'contacted', 'completed', 'archived'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        // Reverse: drop the new table and recreate the old one
        Schema::dropIfExists('contact_submissions');
        
        Schema::create('contact_submission', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('company')->nullable();
            $table->string('service_interest');
            $table->string('city');
            $table->text('project_description');
            $table->enum('status', ['pending', 'contacted', 'completed', 'archived'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }
};
<?php
// database/migrations/2024_01_01_000002_create_job_applications_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            
            // Job relationship
            $table->unsignedBigInteger('job_id');
            $table->string('job_title');
            $table->string('job_department')->nullable();
            $table->string('job_location')->nullable();
            $table->string('job_type')->nullable();
            
            // Applicant personal details
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('country_code')->nullable();
            $table->string('location'); // Current location of applicant
            $table->string('experience'); // Experience level (0-1, 1-3, etc.)
            
            // Application details
            $table->text('cover_letter');
            $table->string('resume_path');
            $table->string('resume_original_name')->nullable();
            $table->string('resume_file_size')->nullable();
            
            // Status tracking
            $table->enum('status', ['pending', 'reviewed', 'shortlisted', 'rejected', 'hired'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->unsignedBigInteger('reviewed_by')->nullable();
            
            // IP Address & tracking
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            
            // Terms agreement
            $table->boolean('terms_agreed')->default(true);
            
            $table->timestamps();
            
            // Indexes
            $table->index('job_id');
            $table->index('email');
            $table->index('status');
            $table->index('created_at');
            
            // Foreign key constraint (if you want to link to career_jobs table)
            $table->foreign('job_id')
                  ->references('id')
                  ->on('career_jobs')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_applications');
    }
};
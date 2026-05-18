<?php
// database/migrations/2024_01_01_000001_create_jobs_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('career_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('department');
            $table->string('location');
            $table->string('employment_type'); // full-time, part-time, contract, freelance, internship
            $table->integer('experience'); // years of experience
            $table->text('short_description');
            $table->longText('description');
            $table->boolean('status')->default(1); // 1 = active, 0 = inactive
            $table->date('created_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('career_jobs');
    }
};
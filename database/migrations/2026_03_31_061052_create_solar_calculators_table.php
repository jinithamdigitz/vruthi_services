<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('solar_calculators', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location')->nullable();
            $table->string('contact_number');
            $table->string('email')->nullable();
            $table->integer('daily_consumption');
            $table->integer('monthly_bill');
            $table->enum('system_type', ['on_grid', 'off_grid', 'hybrid'])->default('on_grid');
            $table->decimal('estimated_savings', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solar_calculators');
    }
};
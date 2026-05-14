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
        Schema::create('multiple_images', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name or path of the image
            $table->foreignId('program_id')->constrained('programs')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('multiple_images');
    }
};

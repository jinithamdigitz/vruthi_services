<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

public function up()
{
    Schema::create('events', function (Blueprint $table) {
        $table->id(); // id as primary key
        $table->string('name', 250);
        $table->string('image')->nullable();
        $table->text('description')->nullable();
        $table->dateTime('created_date')->nullable();
        $table->timestamps();
    });
}

   public function down()
{
    Schema::dropIfExists('events');
}

};

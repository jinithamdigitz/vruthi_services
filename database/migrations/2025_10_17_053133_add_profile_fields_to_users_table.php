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
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_image')->nullable()->after('password');
            $table->string('location')->nullable()->after('profile_image');
            $table->text('description')->nullable()->after('location');
            $table->string('cover_image')->nullable()->after('description');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['profile_image', 'location', 'description', 'cover_image']);
        });
    }
};

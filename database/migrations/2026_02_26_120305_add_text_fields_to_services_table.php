<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->text('text1')->nullable()->after('description');
            $table->text('text2')->nullable()->after('text1');
            $table->text('text3')->nullable()->after('text2');
        });
    }

    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['text1', 'text2', 'text3']);
        });
    }
};
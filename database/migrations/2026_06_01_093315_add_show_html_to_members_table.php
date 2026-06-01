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
    Schema::table('members', function (Blueprint $table) {

        $table->tinyInteger('show_html')
            ->default(0)
            ->comment('0 = Plain Text, 1 = HTML/CKEditor')
            ->after('description');

    });
}

public function down(): void
{
    Schema::table('members', function (Blueprint $table) {

        $table->dropColumn('show_html');

    });
}
};

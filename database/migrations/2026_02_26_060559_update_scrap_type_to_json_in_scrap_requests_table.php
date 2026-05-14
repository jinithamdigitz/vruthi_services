<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('scrap_requests', function (Blueprint $table) {
            $table->json('scrap_type')->change();
        });
    }

    public function down(): void
    {
        Schema::table('scrap_requests', function (Blueprint $table) {
            $table->string('scrap_type')->change();
        });
    }
};

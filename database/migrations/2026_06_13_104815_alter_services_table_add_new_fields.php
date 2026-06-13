<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {

            $table->text('short_description')
                ->nullable()
                ->after('slug');

            $table->longText('features')
                ->nullable()
                ->after('body');

            $table->integer('sort_order')
                ->default(0)
                ->after('keyword');

            $table->boolean('is_active')
                ->default(true)
                ->after('sort_order');
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {

            $table->dropColumn([
                'short_description',
                'features',
                'sort_order',
                'is_active'
            ]);
        });
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up()
    {
        // Check if slug column exists, drop it if it does
        if (Schema::hasColumn('services', 'slug')) {
            Schema::table('services', function (Blueprint $table) {
                // Drop the unique constraint first
                $table->dropUnique(['slug']);
                // Then drop the column
                $table->dropColumn('slug');
            });
        }

        // Step 1: Add slug column as nullable first (without unique)
        Schema::table('services', function (Blueprint $table) {
            $table->string('slug', 191)->nullable()->after('title');
        });

        // Step 2: Generate slugs for existing services
        $services = DB::table('services')->get();
        foreach ($services as $service) {
            $slug = Str::slug($service->title);
            
            // Make sure slug is unique
            $originalSlug = $slug;
            $count = 1;
            while (DB::table('services')->where('slug', $slug)->where('id', '!=', $service->id)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }
            
            DB::table('services')
                ->where('id', $service->id)
                ->update(['slug' => $slug]);
        }

        // Step 3: Add unique constraint after data is populated
        Schema::table('services', function (Blueprint $table) {
            $table->unique('slug');
        });
        
        // Step 4: Make slug column required (not nullable)
        Schema::table('services', function (Blueprint $table) {
            $table->string('slug', 191)->nullable(false)->change();
        });
    }

    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
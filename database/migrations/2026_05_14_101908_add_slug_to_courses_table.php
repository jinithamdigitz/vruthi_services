<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->string('slug')->unique()->after('course_name');
        });

        // Generate slugs for existing courses
        $courses = DB::table('courses')->get();
        foreach ($courses as $course) {
            DB::table('courses')
                ->where('id', $course->id)
                ->update(['slug' => Str::slug($course->course_name)]);
        }
    }

    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
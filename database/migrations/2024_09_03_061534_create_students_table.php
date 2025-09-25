<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('branch_id')->nullable()->change();
            $table->string('batch_id')->nullable()->change();
            $table->string('course_id')->nullable()->change();
            $table->unique('student_id', 'students_student_id_unique');

            // Deprecated: student-wide fast-track.
            // Keep column but stop using it; per-enrollment has is_fast_track now.
            $table->boolean('isFastTrack')->default(0)->change();
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropUnique('students_student_id_unique');
        });
    }
}

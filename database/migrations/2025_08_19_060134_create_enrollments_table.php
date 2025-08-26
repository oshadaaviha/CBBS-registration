<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();

            // EXACT same type as students.id (BIGINT UNSIGNED)
            $table->unsignedBigInteger('student_id');

            // Your domain keys are strings -> keep them strings
            $table->string('course_id');
            $table->string('branch_id')->nullable();
            $table->string('batch_id')->nullable();

            $table->string('track')->nullable();     // 'Normal' | 'Fast'
            $table->boolean('is_fast_track')->default(false);
            $table->string('preferred_class')->nullable();
            $table->string('status')->nullable();    // per-enrollment status
            $table->timestamps();

            // Indexes first (MySQL likes this when adding FKs)
            $table->index('student_id');
            $table->index(['course_id','branch_id','batch_id']);

            // FKs (order matters; referenced tables must already exist)
            $table->foreign('student_id')
                  ->references('id')->on('students')
                  ->onDelete('cascade');

            $table->foreign('course_id')
                  ->references('course_id')->on('courses');

            $table->foreign('branch_id')
                  ->references('branch_id')->on('branches');

            $table->foreign('batch_id')
                  ->references('batch_id')->on('batches');

            // Optional uniqueness to avoid duplicate exact enrollments
            // $table->unique(['student_id','course_id','branch_id','batch_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};


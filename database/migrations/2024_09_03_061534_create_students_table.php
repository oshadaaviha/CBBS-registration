<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_id');
            $table->string('name')->nullable();
            $table->string('nic');
            $table->string('email');
            $table->string('gender');
            $table->string('contact_number');
            $table->string('whatsapp_number');
            $table->string('address');
            $table->string('branch_id');
            $table->string('course_id');
            $table->string('batch_id');
            $table->string('isFastTack');
            $table->boolean('isFastTrack')->default(0);
            $table->boolean('isActive')->default('1');
            $table->timestamps();

            // index
            $table->index('branch_id');
            $table->index('course_id');
            $table->index('batch_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}

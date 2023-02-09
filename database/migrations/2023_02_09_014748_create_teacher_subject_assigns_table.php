<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherSubjectAssignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_subject_assigns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher');
            $table->unsignedBigInteger('trimester');
            $table->unsignedBigInteger('batch');
            $table->unsignedBigInteger('subject');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher_subject_assigns');
    }
}

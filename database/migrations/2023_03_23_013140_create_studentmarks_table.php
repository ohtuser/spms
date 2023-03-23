<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentmarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studentmarks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('trimester_id');
            $table->unsignedBigInteger('subject_id');
            $table->double('cr1')->default(0);
            $table->double('cr2')->default(0);
            $table->double('cr3')->default(0);
            $table->double('cr4')->default(0);
            $table->double('cr5')->default(0);
            $table->double('cr6')->default(0);
            $table->double('cr7')->default(0);
            $table->double('cr8')->default(0);
            $table->double('cr9')->default(0);
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
        Schema::dropIfExists('studentmarks');
    }
}

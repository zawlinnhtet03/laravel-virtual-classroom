<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesTable extends Migration
{
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->unsignedBigInteger('subject_id'); // Add this line for subject_id
            $table->unsignedBigInteger('created_by');
            $table->timestamps();

            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade'); // Add foreign key constraint for subject_id
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('quizzes');
    }
}

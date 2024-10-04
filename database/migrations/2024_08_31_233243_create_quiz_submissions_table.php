<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_submissions', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('quiz_attempt_id'); // Foreign key for quiz_attempts table
            $table->unsignedBigInteger('question_id'); // Foreign key for questions table
            $table->integer('selected_option'); // 1-based index for selected option
            $table->boolean('is_correct')->nullable(); // Optional boolean for correctness of the selected option
            $table->timestamps(); // Created at and updated at timestamps

            // Foreign key constraints
            $table->foreign('quiz_attempt_id')->references('id')->on('quiz_attempts')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_submissions');
    }
}

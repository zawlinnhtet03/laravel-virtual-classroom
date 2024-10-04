<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->dateTime('due_date');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('subject_id');
            $table->string('attachment')->nullable(); 
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('teachers')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('assignments', function (Blueprint $table) {
            $table->dropColumn('attachment'); 
        });

        Schema::dropIfExists('assignments');
    }
};

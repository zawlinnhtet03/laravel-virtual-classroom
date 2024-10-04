<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('subject_id')->nullable();
            $table->string('subject_name')->nullable();
            $table->timestamps();
        });

        // DB::table('subjects')->insert([
        //     [
        //         'subject_id'   => 'MATH101',
        //         'subject_name' => 'Mathematics',
        //     ],
        //     [
        //         'subject_id'   => 'MATH101',
        //         'subject_name' => 'Mathematics',
        //     ],
        //     [
        //         'subject_id'   => 'MATH101',
        //         'subject_name' => 'Mathematics',
        //     ],
        //     [
        //         'subject_id'   => 'MATH101',
        //         'subject_name' => 'Mathematics',
        //     ],
        //     [
        //         'subject_id'   => 'MATH101',
        //         'subject_name' => 'Mathematics',
        //     ],
        // ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};

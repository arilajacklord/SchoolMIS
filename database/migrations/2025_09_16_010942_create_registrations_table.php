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
        Schema::create('registration', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');

            // Student info
            $table->string('student_name');
            $table->string('course_level');
            $table->string('student_address');
            $table->string('student_phone_num');
            $table->string('student_status');
            $table->string('student_citizenship');
            $table->date('student_birthdate');
            $table->string('student_religion');
            $table->integer('student_age');

            // Father info
            $table->string('father_Fname');
            $table->string('father_Mname');
            $table->string('father_Lname');
            $table->string('father_address');
            $table->string('father_cell_no');
            $table->integer('father_age');
            $table->string('father_religion');
            $table->date('father_birthdate');
            $table->string('father_profession');
            $table->string('father_occupation');

            // Mother info
            $table->string('mother_Fname');
            $table->string('mother_Mname');
            $table->string('mother_Lname');
            $table->string('mother_address');
            $table->string('mother_cell_no');
            $table->integer('mother_age');
            $table->string('mother_religion');
            $table->date('mother_birthdate');
            $table->string('mother_profession');
            $table->string('mother_occupation');

            $table->timestamps();

            // Optional foreign key to users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registration');
    }
};

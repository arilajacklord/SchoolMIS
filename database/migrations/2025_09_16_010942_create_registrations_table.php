<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registration', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');

            $table->string('student_Fname');
            $table->string('student_Mname')->nullable();
            $table->string('student_Lname');

            $table->string('course_level')->nullable();
            $table->string('student_address')->nullable();
            $table->string('student_phone_num')->nullable();
            $table->string('student_status')->nullable();
            $table->string('student_citizenship')->nullable();
            $table->date('student_birthdate')->nullable();
            $table->string('student_religion')->nullable();
            $table->integer('student_age')->nullable();

            // Father info
            $table->string('father_Fname')->nullable();
            $table->string('father_Mname')->nullable();
            $table->string('father_Lname')->nullable();
            $table->string('father_address')->nullable();
            $table->string('father_cell_no')->nullable();
            $table->integer('father_age')->nullable();
            $table->string('father_religion')->nullable();
            $table->date('father_birthdate')->nullable();
            $table->string('father_profession')->nullable();
            $table->string('father_occupation')->nullable();

            // Mother info
            $table->string('mother_Fname')->nullable();
            $table->string('mother_Mname')->nullable();
            $table->string('mother_Lname')->nullable();
            $table->string('mother_address')->nullable();
            $table->string('mother_cell_no')->nullable();
            $table->integer('mother_age')->nullable();
            $table->string('mother_religion')->nullable();
            $table->date('mother_birthdate')->nullable();
            $table->string('mother_profession')->nullable();
            $table->string('mother_occupation')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registration');
    }
};

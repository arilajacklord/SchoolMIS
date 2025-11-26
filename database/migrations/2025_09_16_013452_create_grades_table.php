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
        Schema::create('grades', function (Blueprint $table) {
    $table->id('grade_id');
    $table->unsignedBigInteger('enroll_id');
    $table->decimal('prelim', 5, 2)->nullable();
    $table->decimal('midterm', 5, 2)->nullable();
    $table->decimal('semifinal', 5, 2)->nullable();
    $table->decimal('final', 5, 2)->nullable();
    $table->timestamps();

    $table->foreign('enroll_id')->references('enroll_id')->on('enrollments')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
 {
    public function up(): void
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id('subject_id'); // Primary key
            $table->string('course_code', 50);
            $table->string('descriptive_title', 255);
            $table->integer('lec_units')->default(0);
            $table->integer('lab_units')->default(0);
            $table->integer('total_units')->virtualAs('lec_units + lab_units'); // Optional for auto-calculation
            $table->string('co_requisite', 255)->nullable();
            $table->string('pre_requisite', 255)->nullable();
        });
    }
 
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};

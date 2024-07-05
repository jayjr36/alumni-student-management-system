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
        Schema::create('mentor_mentee', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentor_id')
                  ->constrained('alumni')
                  ->onDelete('cascade')->name('mentor_mentee_alumni_id');
            $table->foreignId('student_id')
                  ->constrained('students')
                  ->onDelete('cascade')->name('mentor_mentee_student_id');
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentor_mentee');
    }
};

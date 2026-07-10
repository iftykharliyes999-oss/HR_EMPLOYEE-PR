<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {

            $table->id();

            // Employee
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Attendance Date
            $table->date('date');

            // Clock In / Out
            $table->time('clock_in')->nullable();
            $table->time('clock_out')->nullable();

            // Attendance Status
            $table->enum('status', [
                'Present',
                'Late',
                'Absent'
            ])->default('Absent');

            // Total Working Hours
            $table->string('working_hours')->nullable();

            $table->timestamps();

            // একই দিনে একজন employee যেন একবারই attendance দিতে পারে
            $table->unique(['user_id', 'date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};

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
    Schema::create('leaves', function (Blueprint $table) {

        $table->id();

        // Employee
        $table->foreignId('employee_id')
            ->constrained('users')
            ->cascadeOnDelete();

        // Employee-এর assigned Manager
        $table->foreignId('manager_id')
            ->constrained('users')
            ->cascadeOnDelete();

        // Leave Information
        $table->enum('leave_type',[
            'Casual',
            'Sick',
            'Annual',
            'Emergency',
            'Unpaid'
        ]);

        $table->date('start_date');
        $table->date('end_date');

        $table->integer('total_days');

        $table->text('reason');

        $table->string('attachment')->nullable();

        // Workflow
        $table->enum('manager_status',[
            'Pending',
            'Approved',
            'Rejected'
        ])->default('Pending');

        $table->enum('admin_status',[
            'Pending',
            'Approved',
            'Rejected'
        ])->default('Pending');

        $table->text('manager_comment')->nullable();

        $table->text('admin_comment')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};

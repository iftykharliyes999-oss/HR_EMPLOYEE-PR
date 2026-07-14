<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {

            $table->id();

            $table->string('title');

            $table->longText('description');

            $table->foreignId('employee_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('manager_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('created_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->enum('priority',[
                'Low',
                'Medium',
                'High',
                'Urgent'
            ])->default('Medium');

            $table->enum('status',[
                'Pending',
                'In Progress',
                'Completed',
                'Rejected',
                'Overdue'
            ])->default('Pending');

            $table->date('start_date')->nullable();

            $table->date('due_date');

            $table->string('attachment')->nullable();

            $table->string('submitted_file')->nullable();

            $table->text('employee_comment')->nullable();

            $table->text('manager_comment')->nullable();

            $table->timestamp('started_at')->nullable();

            $table->timestamp('submitted_at')->nullable();

            $table->timestamp('completed_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};

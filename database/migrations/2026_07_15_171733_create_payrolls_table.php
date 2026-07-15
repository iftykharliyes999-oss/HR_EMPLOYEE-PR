<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('processed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->unsignedTinyInteger('salary_month');
            $table->unsignedSmallInteger('salary_year');

            $table->decimal('base_salary', 12, 2);

            $table->decimal('festival_bonus', 12, 2)
                ->default(0);

            $table->decimal('other_bonus', 12, 2)
                ->default(0);

            $table->decimal('overtime_amount', 12, 2)
                ->default(0);

            $table->decimal('absence_deduction', 12, 2)
                ->default(0);

            $table->decimal('other_deduction', 12, 2)
                ->default(0);

            $table->decimal('gross_salary', 12, 2);

            $table->decimal('total_deduction', 12, 2)
                ->default(0);

            $table->decimal('net_salary', 12, 2);

            $table->string('status')
                ->default('Draft');

            $table->date('payment_date')
                ->nullable();

            $table->string('payment_method')
                ->nullable();

            $table->string('transaction_reference')
                ->nullable();

            $table->text('note')
                ->nullable();

            $table->timestamps();

            $table->unique([
                'user_id',
                'salary_month',
                'salary_year',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};

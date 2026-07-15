<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loan_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->decimal('requested_amount', 12, 2);

            $table->unsignedInteger('installment_months');

            $table->decimal('monthly_installment', 12, 2)
                ->default(0);

            $table->decimal('remaining_balance', 12, 2)
                ->default(0);

            $table->text('reason');

            $table->string('status')
                ->default('Pending');

            $table->foreignId('reviewed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('reviewed_at')
                ->nullable();

            $table->text('admin_note')
                ->nullable();

            $table->date('deduction_start_month')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loan_requests');
    }
};

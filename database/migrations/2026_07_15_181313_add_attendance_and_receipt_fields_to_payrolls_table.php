<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payrolls', function (Blueprint $table) {

            $table->unsignedInteger('actual_absent_days')
                ->default(0)
                ->after('overtime_amount');

            $table->unsignedInteger('late_count')
                ->default(0)
                ->after('actual_absent_days');

            $table->unsignedInteger('late_penalty_days')
                ->default(0)
                ->after('late_count');

            $table->unsignedInteger('total_deductible_days')
                ->default(0)
                ->after('late_penalty_days');

            $table->foreignId('paid_by')
                ->nullable()
                ->after('status')
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('paid_at')
                ->nullable()
                ->after('paid_by');

            $table->string('recipient_status')
                ->default('Pending')
                ->after('paid_at');

            $table->timestamp('received_at')
                ->nullable()
                ->after('recipient_status');
        });
    }

    public function down(): void
    {
        Schema::table('payrolls', function (Blueprint $table) {

            $table->dropForeign(['paid_by']);

            $table->dropColumn([
                'actual_absent_days',
                'late_count',
                'late_penalty_days',
                'total_deductible_days',
                'paid_by',
                'paid_at',
                'recipient_status',
                'received_at',
            ]);
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payrolls', function (Blueprint $table) {

            if (!Schema::hasColumn('payrolls', 'house_allowance')) {
                $table->decimal('house_allowance', 12, 2)
                    ->default(0)
                    ->after('base_salary');
            }

            if (!Schema::hasColumn('payrolls', 'medical_allowance')) {
                $table->decimal('medical_allowance', 12, 2)
                    ->default(0)
                    ->after('house_allowance');
            }

            if (!Schema::hasColumn('payrolls', 'transport_allowance')) {
                $table->decimal('transport_allowance', 12, 2)
                    ->default(0)
                    ->after('medical_allowance');
            }

            if (!Schema::hasColumn('payrolls', 'food_allowance')) {
                $table->decimal('food_allowance', 12, 2)
                    ->default(0)
                    ->after('transport_allowance');
            }

            if (!Schema::hasColumn('payrolls', 'performance_bonus')) {
                $table->decimal('performance_bonus', 12, 2)
                    ->default(0)
                    ->after('festival_bonus');
            }

            if (!Schema::hasColumn('payrolls', 'tax_deduction')) {
                $table->decimal('tax_deduction', 12, 2)
                    ->default(0)
                    ->after('absence_deduction');
            }

            if (!Schema::hasColumn('payrolls', 'loan_deduction')) {
                $table->decimal('loan_deduction', 12, 2)
                    ->default(0)
                    ->after('tax_deduction');
            }

            if (!Schema::hasColumn('payrolls', 'advance_deduction')) {
                $table->decimal('advance_deduction', 12, 2)
                    ->default(0)
                    ->after('loan_deduction');
            }
        });
    }

    public function down(): void
    {
        Schema::table('payrolls', function (Blueprint $table) {

            $columns = [
                'house_allowance',
                'medical_allowance',
                'transport_allowance',
                'food_allowance',
                'performance_bonus',
                'tax_deduction',
                'loan_deduction',
                'advance_deduction',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('payrolls', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('attendances', function (Blueprint $table) {

            if (!Schema::hasColumn('attendances', 'manager_id')) {
                $table->foreignId('manager_id')
                    ->nullable()
                    ->after('user_id')
                    ->constrained('users')
                    ->nullOnDelete();
            }

            if (!Schema::hasColumn(
                'attendances',
                'clock_in_approval_status'
            )) {
                $table->string('clock_in_approval_status')
                    ->default('Pending')
                    ->after('clock_in');
            }

            if (!Schema::hasColumn(
                'attendances',
                'clock_out_approval_status'
            )) {
                $table->string('clock_out_approval_status')
                    ->default('Not Submitted')
                    ->after('clock_out');
            }

            if (!Schema::hasColumn(
                'attendances',
                'clock_in_approved_by'
            )) {
                $table->foreignId('clock_in_approved_by')
                    ->nullable()
                    ->constrained('users')
                    ->nullOnDelete();
            }

            if (!Schema::hasColumn(
                'attendances',
                'clock_out_approved_by'
            )) {
                $table->foreignId('clock_out_approved_by')
                    ->nullable()
                    ->constrained('users')
                    ->nullOnDelete();
            }

            if (!Schema::hasColumn(
                'attendances',
                'clock_in_approved_at'
            )) {
                $table->timestamp('clock_in_approved_at')
                    ->nullable();
            }

            if (!Schema::hasColumn(
                'attendances',
                'clock_out_approved_at'
            )) {
                $table->timestamp('clock_out_approved_at')
                    ->nullable();
            }

            if (!Schema::hasColumn(
                'attendances',
                'late_minutes'
            )) {
                $table->unsignedInteger('late_minutes')
                    ->default(0)
                    ->after('status');
            }
        });
    }

    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {

            if (Schema::hasColumn('attendances', 'manager_id')) {
                $table->dropForeign(['manager_id']);
                $table->dropColumn('manager_id');
            }

            if (Schema::hasColumn(
                'attendances',
                'clock_in_approved_by'
            )) {
                $table->dropForeign(['clock_in_approved_by']);
                $table->dropColumn('clock_in_approved_by');
            }

            if (Schema::hasColumn(
                'attendances',
                'clock_out_approved_by'
            )) {
                $table->dropForeign(['clock_out_approved_by']);
                $table->dropColumn('clock_out_approved_by');
            }

            $columns = [
                'clock_in_approval_status',
                'clock_out_approval_status',
                'clock_in_approved_at',
                'clock_out_approved_at',
                'late_minutes',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('attendances', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->foreignId('manager_id')
                ->nullable()
                ->after('user_id')
                ->constrained('users')
                ->nullOnDelete();

            $table->enum('clock_in_approval_status', [
                'Pending',
                'Approved',
                'Rejected',
            ])->default('Pending')->after('clock_in');

            $table->enum('clock_out_approval_status', [
                'Not Submitted',
                'Pending',
                'Approved',
                'Rejected',
            ])->default('Not Submitted')->after('clock_out');

            $table->foreignId('clock_in_approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('clock_out_approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('clock_in_approved_at')->nullable();
            $table->timestamp('clock_out_approved_at')->nullable();

            $table->unsignedInteger('late_minutes')->default(0);

            $table->enum('status', [
                'Present',
                'Late',
                'Absent',
                'Leave',
                'Holiday',
            ])->default('Absent')->change();
        });
    }

    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropForeign([
                'manager_id',
            ]);

            $table->dropForeign([
                'clock_in_approved_by',
            ]);

            $table->dropForeign([
                'clock_out_approved_by',
            ]);

            $table->dropColumn([
                'manager_id',
                'clock_in_approval_status',
                'clock_out_approval_status',
                'clock_in_approved_by',
                'clock_out_approved_by',
                'clock_in_approved_at',
                'clock_out_approved_at',
                'late_minutes',
            ]);
        });
    }
};

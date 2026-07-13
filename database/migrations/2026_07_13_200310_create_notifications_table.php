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
    Schema::create('notifications', function (Blueprint $table) {

        $table->id();

        $table->string('title');

        $table->string('slug')->unique();

        $table->text('message');

        $table->enum('priority', [
            'Normal',
            'Important',
            'Urgent'
        ])->default('Normal');

        $table->enum('audience', [
            'All',
            'Managers',
            'Employees'
        ])->default('All');

        $table->string('attachment')->nullable();

        $table->timestamp('publish_at')->nullable();

        $table->timestamp('expire_at')->nullable();

        $table->enum('status', [
            'Draft',
            'Published'
        ])->default('Draft');

        $table->foreignId('created_by')
            ->constrained('users')
            ->cascadeOnDelete();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};

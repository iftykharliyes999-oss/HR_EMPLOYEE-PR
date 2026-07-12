<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('holidays', function (Blueprint $table) {

            $table->id();

            $table->string('title');

            $table->date('start_date');

            $table->date('end_date');

            $table->integer('total_days');

            $table->text('description')->nullable();

            $table->enum('status', [
                'Active',
                'Inactive'
            ])->default('Active');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('holidays');
    }
};

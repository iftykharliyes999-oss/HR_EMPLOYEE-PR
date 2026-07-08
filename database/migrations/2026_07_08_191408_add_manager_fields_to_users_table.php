<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('phone')->nullable();

            $table->string('department')->nullable();

            $table->string('designation')->nullable();

            $table->decimal('salary', 10, 2)->nullable();

            $table->string('gender')->nullable();

            $table->date('joining_date')->nullable();

            $table->text('address')->nullable();

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn([
                'phone',
                'department',
                'designation',
                'salary',
                'gender',
                'joining_date',
                'address',
            ]);

        });
    }
};

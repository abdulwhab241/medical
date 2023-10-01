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
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_employee_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('the_job');
            $table->string('section')->nullable();
            $table->longText('disc');
            $table->decimal('the_salary',50,2);
            $table->decimal('suits',50,2)->default(0); //بدلات
            $table->decimal('discounts',50,2)->default(0); // خصومات
            $table->decimal('total',50,2);
            $table->date('date');
            $table->integer('year');
            $table->string('create_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};

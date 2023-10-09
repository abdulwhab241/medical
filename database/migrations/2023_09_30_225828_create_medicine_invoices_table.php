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
        Schema::create('medicine_invoices', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('patient_id')->references('id')->on('patients')->onDelete('cascade');
            // $table->foreignId('user_doctor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('patient_medicine_id')->references('id')->on('patient_medicines')->onDelete('cascade');
            // $table->foreignId('medicine_id')->nullable()->references('id')->on('medicines')->onDelete('cascade');
            $table->decimal('price', 50, 2)->default(0);
            $table->integer('quantity')->default(1);
            $table->decimal('total', 50, 2)->default(0);
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
        Schema::dropIfExists('medicine_invoices');
    }
};

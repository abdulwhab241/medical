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
        Schema::create('receipt_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreignId('user_doctor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('service_id')->nullable()->references('id')->on('services')->onDelete('cascade');
            $table->decimal('amount',50,2)->nullable();
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
        Schema::dropIfExists('receipt_accounts');
    }
};

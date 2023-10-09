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
        Schema::create('patient_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreignId('invoice_id')->nullable()->references('id')->on('invoices')->onDelete('cascade');
            $table->foreignId('insurance_invoice_id')->nullable()->references('id')->on('insurance_invoices')->onDelete('cascade');
            $table->foreignId('diagnostic_id')->nullable()->references('id')->on('diagnostics')->onDelete('cascade');
            $table->foreignId('medicine_id')->nullable()->references('id')->on('medicine_invoices')->onDelete('cascade');
            $table->foreignId('user_doctor_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('payment_id')->nullable()->references('id')->on('payment_accounts')->onDelete('cascade');
            $table->foreignId('service_id')->nullable()->references('id')->on('services')->onDelete('cascade');
            $table->decimal('Debit',50,2)->default(0);
            $table->decimal('credit',50,2)->default(0);
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
        Schema::dropIfExists('patient_accounts');
    }
};

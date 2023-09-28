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
        Schema::create('insurance_invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_type');
            $table->foreignId('insurance_id')->references('id')->on('insurances')->onDelete('cascade'); /// 
            $table->string('subscriber_number');
            $table->foreignId('patient_id')->nullable()->references('id')->on('patients')->onDelete('cascade');
            $table->foreignId('user_doctor_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->foreignId('service_id')->nullable()->references('id')->on('services')->onDelete('cascade');
            $table->decimal('price', 50, 2)->default(0);
            $table->decimal('discount_percentage')->default(0); //نسبة تحمل المريض
            $table->decimal('company_rate')->default(0);        // نسبة تحمل الشركة
            $table->decimal('total_invoice', 50, 2)->default(0); // مجموع الفاتورة
            $table->decimal('total_patient', 50, 2)->default(0); // مجموع المريض
            $table->date('date');
            $table->integer('year');
            $table->string('create_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurance_invoices');
    }
};

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
        Schema::create('diagnostics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
            $table->foreignId('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreignId('user_doctor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('medicine_id')->nullable()->references('id')->on('medicines')->onDelete('cascade');
            $table->foreignId('service_id')->nullable()->references('id')->on('services')->onDelete('cascade');
            $table->foreignId('insurance_invoice_id')->nullable()->references('id')->on('insurance_invoices')->onDelete('cascade');
            $table->dateTime('review_date')->nullable();
            $table->longText('diagnosis');
            $table->longText('dosage'); //  الجرعة
            $table->string('use'); //  وقت الجرعة
            $table->string('period'); //  الفترة
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
        Schema::dropIfExists('diagnostics');
    }
};

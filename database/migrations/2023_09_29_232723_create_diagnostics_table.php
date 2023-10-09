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
            $table->foreignId('invoice_id')->nullable()->references('id')->on('invoices')->onDelete('cascade');
            $table->foreignId('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreignId('user_doctor_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('insurance_invoice_id')->nullable()->references('id')->on('insurance_invoices')->onDelete('cascade');
            $table->dateTime('review_date')->nullable();
            $table->longText('diagnosis');
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

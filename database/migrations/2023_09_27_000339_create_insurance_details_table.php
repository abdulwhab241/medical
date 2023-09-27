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
        Schema::create('insurance_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('insurance_id')->references('id')->on('insurances')->onDelete('cascade');
            $table->string('name');
            $table->string('insurance_code');
            $table->string('discount_percentage');
            $table->string('company_rate');
            $table->longText('notes')->nullable();
            $table->boolean('status');
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
        Schema::dropIfExists('insurance_details');
    }
};
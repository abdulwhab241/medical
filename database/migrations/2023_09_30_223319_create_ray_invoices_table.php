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
        Schema::create('ray_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ray_id')->references('id')->on('patient_rays')->onDelete('cascade');
            $table->decimal('price', 50, 2)->default(0);
            $table->integer('discount')->default(0);
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
        Schema::dropIfExists('ray_invoices');
    }
};

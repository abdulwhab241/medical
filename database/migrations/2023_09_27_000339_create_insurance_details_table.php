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
            $table->string('name');  // الأسم موظف او اولاد الموظف او الزوجة او الوالدين
            $table->string('insurance_code');  //  رقم المشترك
            $table->integer('discount_percentage')->default(0);  // نسبة تحمل المريض
            $table->integer('company_rate');  // نسبة تحمل الشركة
            $table->longText('notes')->nullable(); //
            $table->boolean('status');  // حالة التأمين مفعل او موقف
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
        Schema::dropIfExists('insurance_details');
    }
};

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
        Schema::create('fund_accounts', function (Blueprint $table) {
            $table->id();
                        ///  المريض
            $table->foreignId('patient_id')->nullable()->references('id')->on('patients')->onDelete('cascade');
            
            //             ///  الموظفين من اجل تسليم الرواتب
            // $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            
                        ///  سندات القبض (مدين)
            $table->foreignId('receipt_id')->nullable()->references('id')->on('receipt_accounts')->onDelete('cascade'); /// مدين
            
                        ///  سندات الصرف (دائن)
            $table->foreignId('payment_id')->nullable()->references('id')->on('payment_accounts')->onDelete('cascade'); /// دائن
            
                        ///  صرف الرواتب (دائن)
            $table->foreignId('salary_id')->nullable()->references('id')->on('salaries')->onDelete('cascade'); /// دائن
            
                        ///  المصروفات (دائن)
            $table->foreignId('expense_id')->nullable()->references('id')->on('expenses')->onDelete('cascade'); /// دائن
            
                        ///  شركات التأمين (مدين)
            $table->foreignId('company_id')->nullable()->references('id')->on('companies')->onDelete('cascade'); /// مدين
            
                        ///  سندات القبض (دائن)
            $table->foreignId('insurance_id')->nullable()->references('id')->on('insurance_invoices')->onDelete('cascade'); /// مدين
            
            $table->decimal('Debit',50,2)->default(0); /// مدين
            $table->decimal('credit',50,2)->default(0); /// دائن
            
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
        Schema::dropIfExists('fund_accounts');
    }
};

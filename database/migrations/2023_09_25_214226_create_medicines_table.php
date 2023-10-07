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
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();

            ///   مشتريات الادوية  ///

            $table->longText('name');  
            $table->longText('bar_code')->nullable();
            $table->longText('supplier');  // المورد
            $table->string('unit'); // باكت او علبة او قلم 
            $table->integer('quantity');
            $table->decimal('buy_price', 50, 2);  // سعر الشراء
            $table->decimal('sale_price', 50, 2);  // سعر البيع 
            $table->date('end_date');
            $table->decimal('total', 50, 2);
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
        Schema::dropIfExists('medicines');
    }
};

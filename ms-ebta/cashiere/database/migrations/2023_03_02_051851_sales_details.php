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
        Schema::create('sales_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sale_id');
            $table->integer('product_id');
            $table->integer('qty');
            $table->integer('selling_price');
            $table->tinyInteger('discount')->default(0);
            $table->integer('subtotal_prices');
            $table->integer('customer_money');
            $table->timestamps('');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_sales');
    }
};

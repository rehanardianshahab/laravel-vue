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
        Schema::table('products', function (Blueprint $table) {
                $table->unsignedInteger('category_id')->change();
                $table->foreign('category_id')
                      ->references('id')->on('categories')
                      ->onUpdate('restrict')
                      ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('category_id')->change();
            $table->dripforeign('products_category_id_foreign');
        });
    }
};

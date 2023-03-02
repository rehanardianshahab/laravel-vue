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
        Schema::create('setting', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_store');
            $table->text('address')->nullable;
            $table->string('phone');
            $table->tinyInteger('nota_type');
            $table->string('path_logo');
            $table->string('path_member_card');
            $table->timestamps('');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting');
    }
};

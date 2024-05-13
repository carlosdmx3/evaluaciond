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
        Schema::create('e9criterios', function (Blueprint $table) {
             $table->increments('id')->unsignedBigInteger();
            $table->primary('id');
            $table->string('ocriterio')->nullable(true) ;
            $table->integer('ovalor')->nullable(true) ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e9criterios');
    }
};

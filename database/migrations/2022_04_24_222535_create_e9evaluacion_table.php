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
        Schema::create('e9evaluacion', function (Blueprint $table) {
             $table->increments('id')->unsignedBigInteger();
            $table->primary('id');
            $table->string('odescripcion')->nullable(true) ;
            $table->integer('oseccion')->nullable(true) ;
            $table->integer('onumpregunta')->nullable(true) ;
            $table->integer('oanio')->nullable(true) ;
            $table->integer('oetapa')->nullable(true) ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e9evaluacion');
    }
};

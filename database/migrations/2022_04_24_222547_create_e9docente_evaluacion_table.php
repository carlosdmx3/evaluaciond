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
        Schema::create('e9docente_evaluacion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_alumno_usr');
            $table->unsignedBigInteger('id_docente');

            $table->Integer('op1')->nullable() ;
            $table->Integer('op2')->nullable() ;
            $table->Integer('op3')->nullable() ;
            $table->Integer('op4')->nullable() ;
            $table->Integer('op5')->nullable() ;
            $table->Integer('op6')->nullable() ;
            $table->Integer('op7')->nullable() ;
            $table->Integer('op8')->nullable() ;
            $table->Integer('op9')->nullable() ;
            $table->Integer('op10')->nullable() ;
            $table->Integer('op11')->nullable() ;
            $table->Integer('op12')->nullable() ;
            $table->Integer('op13')->nullable() ;
            $table->Integer('op14')->nullable() ;
            $table->Integer('op15')->nullable() ;
            $table->Integer('op16')->nullable() ;
            $table->Integer('op17')->nullable() ;
            $table->Integer('op18')->nullable() ;
            $table->Integer('op19')->nullable() ;
            $table->Integer('op20')->nullable() ;
            $table->Integer('op21')->nullable() ;
            $table->Integer('op22')->nullable() ;
            $table->Integer('op23')->nullable() ;
            $table->Integer('op24')->nullable() ;
            $table->Integer('op25')->nullable() ;
            $table->Integer('op26')->nullable() ;
            $table->Integer('op27')->nullable() ;
            $table->Integer('op28')->nullable() ;
            $table->Integer('op29')->nullable() ;
            $table->Integer('op30')->nullable() ;
            $table->Integer('op31')->nullable() ;
            $table->Integer('op32')->nullable() ;
            $table->Integer('op33')->nullable() ;
            $table->Integer('op34')->nullable() ;
            $table->Integer('op35')->nullable() ;
            
            $table->Char('status', 1)->default('A') ;
            $table->Integer('oban_fin')->nullable() ;
            $table->timestamps();
            $table->foreign('id_alumno_usr')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_docente')->references('id')->on('e9alumno_docente')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e9docente_evaluacion');
    }
};

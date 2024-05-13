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
        Schema::create('e9alumno_docente', function (Blueprint $table) {
             $table->id();
            $table->unsignedBigInteger('id_user');
            $table->String('onombre')->nullable() ;
            $table->String('osede')->nullable() ;
            $table->Integer('osubsede')->nullable() ;
            $table->String('omatricula')->nullable() ;
            $table->String('ofolio')->nullable() ;
            $table->Char('ogrado', 10)->nullable() ;
            $table->Char('ogrupo', 10)->nullable() ;
            $table->String('oprograma')->nullable() ;
            $table->String('oasignatura')->nullable() ;
            $table->String('odocente')->nullable() ;
            $table->String('omodalidad')->nullable() ;
            $table->Integer('oanio')->nullable() ;
            $table->Integer('oetapa')->nullable() ;
            $table->Integer('oban_fin')->nullable() ;
            $table->timestamps();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e9alumno_docente');
    }
};

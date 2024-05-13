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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable(true);
            $table->string('password');
            $table->string('omatricula')->nullable(true);
            $table->string('ofolio')->nullable(true);
            $table->string('osede')->nullable(true);
            $table->string('osubsede')->nullable(true);
            $table->integer('orol')->default(0);
            $table->integer('oanio')->nullable(true);
            $table->integer('oetapa')->nullable(true);
            $table->integer('oban_fin')->nullable(true);
            $table->string('ocorreo')->nullable(true);
            $table->string('oenvio')->nullable(true);
            $table->string('ofechaenvio')->nullable(true);
            $table->char('status', 1)->default('A');
            $table->char('iusrins', 10)->default('DesSis');
            $table->char('iusrmod', 10)->nullable(true);
            $table->rememberToken();
            $table->timestamps();
            $table->string('password_old')->nullable(true) ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

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
        Schema::create('tb_usuario', function (Blueprint $table) {
            $table->id();
            $table->string('nome_usuario', 100);
            $table->string('email_usuario', 100)->unique();
            $table->string('senha_usuario', 255);
            $table->float('peso_usuario')->nullable();
            $table->float('altura_usuario')->nullable();
            $table->enum('genero_usuario', ['masculino', 'feminino', 'na']);
            $table->date('data_nascimento_usuario')->nullable();
            $table->boolean('hipertenso_usuario');
            $table->boolean('diabetico_usuario');
            $table->string('img_usuario', 36)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_usuario');
    }
};

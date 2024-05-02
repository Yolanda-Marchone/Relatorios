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
        Schema::create('relatorio_mensal', function (Blueprint $table) {
            $table->id();
            $table->string('ano');
            $table->unsignedBigInteger('id_mes');
            $table->foreign('id_mes')
                  ->references('id')
                  ->on('mes')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

                  $table->unsignedBigInteger('id_plataforma');
                  $table->foreign('id_plataforma')
                        ->references('id')
                        ->on('plataformas')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');
              
                  $table->unsignedBigInteger('id_usuario');
                  $table->foreign('id_usuario')
                        ->references('id')
                        ->on('users')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');
              
                  
                  $table->unsignedBigInteger('id_categoria');
                  $table->foreign('id_categoria')
                        ->references('id')
                        ->on('categorias')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');
              
                 $table->string('descricao');
                  $table->integer('disponibilidade');
                
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relatorio_mensal');
    }
};

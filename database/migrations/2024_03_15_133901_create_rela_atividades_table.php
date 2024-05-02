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
        Schema::create('relatorio_atividades', function (Blueprint $table) {
        
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        
            $table->date('data');
            
            $table->unsignedBigInteger('id_solicitante');
            $table->foreign('id_solicitante')
                  ->references('id')
                  ->on('solicitantes');

                  $table->unsignedBigInteger('id_estado');
                  $table->foreign('id_estado')
                        ->references('id')
                        ->on('estados');      
        
         
            $table->date('data_progresso');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relatorio_atividades');
    }
};

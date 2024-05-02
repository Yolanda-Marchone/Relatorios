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
        Schema::create('atividades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->string('descricao');
            $table->string('detalhe');

            $table->unsignedBigInteger('id_solicitante');
            $table->foreign('id_solicitante')
                  ->references('id')
                  ->on('solicitantes')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

                  $table->unsignedBigInteger('id_estado');
                  $table->foreign('id_estado')
                        ->references('id')
                        ->on('estados')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');


         $table->integer('ano');

            $table->unsignedBigInteger('id_mes');
            $table->foreign('id_mes')
                  ->references('id')
                  ->on('mes')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->date('data_progresso');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atividades');
    }
};

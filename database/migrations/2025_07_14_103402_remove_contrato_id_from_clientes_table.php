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
        Schema::table('clientes', function (Blueprint $table) {
            // Primero se elimina la restricción de clave foránea si existe
            $table->dropForeign(['contrato_id']);

            // Luego se elimina la columna
            $table->dropColumn('contrato_id');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->unsignedBigInteger('contrato_id')->nullable();

            // Si decides restaurarla como clave foránea (no recomendado aquí)
            $table->foreign('contrato_id')->references('id')->on('clientes')->onDelete('cascade');
        });

    }
};

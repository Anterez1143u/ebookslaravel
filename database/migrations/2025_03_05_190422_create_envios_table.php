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
        Schema::create('envios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_detalle_id')->constrained('pedidos_detalles')->onDelete('cascade');
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->date('fecha_estimada_entrega')->nullable();
            $table->enum('estado', ['pendiente', 'en camino', 'entregado'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('envios');
    }
};

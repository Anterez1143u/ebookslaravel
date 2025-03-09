<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('pedidos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('usuario_id')->constrained('users');
        $table->decimal('total', 10, 2);
        $table->string('estado')->default('Pendiente');
        $table->timestamps();
    });

    Schema::create('pedido_detalles', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pedido_id')->constrained('pedidos')->onDelete('cascade');
        $table->foreignId('libro_id')->constrained('libros');
        $table->integer('cantidad');
        $table->decimal('precio', 10, 2);
        $table->string('formato'); // 'digital' o 'físico'
        $table->timestamps();
    });
}

};

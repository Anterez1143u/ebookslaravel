<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->foreignId('autor_id')->constrained('users')->onDelete('cascade'); // Autor basado en users
            $table->string('categoria'); // Puede ser un ID si hay una tabla categorias
            $table->string('portada')->nullable(); // Imagen de portada
            $table->string('archivo_pdf'); // PDF del libro
            $table->decimal('precio', 10, 2)->default(0.00); // Precio del libro
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('libros');
    }
};


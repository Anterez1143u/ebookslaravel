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
        Schema::create('carritos', function (Blueprint $table) {
           
                $table->id();
                $table->foreignId('cliente_id')->constrained('users')->onDelete('cascade');
                $table->foreignId('libro_id')->constrained('libros')->onDelete('cascade');
                $table->enum('formato', ['digital', 'físico'])->nullable();
                $table->integer('cantidad')->nullable();
                $table->decimal('precio_unitario', 10, 2)->nullable();
                $table->timestamps();
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carritos');
    }
};

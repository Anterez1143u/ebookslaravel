<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id(); // Este campo es autoincremental automáticamente
            $table->string('name')->unique();
           
            $table->timestamps();
        });

        // Insertar roles por defecto
        \Illuminate\Support\Facades\DB::table('roles')->insert([
            ['id' => 1, 'name' => 'Usuario'],
            ['id' => 2, 'name' => 'Analista'],
            ['id' => 3, 'name' => 'Escritor']
          
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
};


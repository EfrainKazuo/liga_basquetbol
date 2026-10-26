<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jugadores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipo_id')->constrained('equipos')->cascadeOnDelete();
            $table->string('nombre');
            $table->unsignedTinyInteger('numero_camiseta');
            $table->string('posicion');
            $table->decimal('altura', 3, 2);
            $table->date('fecha_nacimiento');
            $table->timestamps();

            $table->unique(['equipo_id', 'numero_camiseta']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jugadores');
    }
};

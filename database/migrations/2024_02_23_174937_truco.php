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
        Schema::create('truco', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('modalidad');
            $table->string('tipo');
            $table->boolean('estado');
            $table->string('fecha_bonus');
            $table->string('descripcion');
            $table->string('recursos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('truco');
    }
};

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
        Schema::create('calificaciones', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('truco_id');
            $table->unsignedBigInteger('juez_id');
            $table->string('score');
            $table->string('puntaje_bonus_date');
            $table->string('source_truco');
            $table->string('like');

            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('truco_id')->references('id')->on('truco');
            $table->foreign('juez_id')->references('id')->on('juez');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calificaciones');
    }
};

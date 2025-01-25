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
        Schema::create('feet', function (Blueprint $table) {
            $table->id();
            $table->json('kits')->nullable(); //Toda la información de los kits. Se puede agregar diferentes tipos de kits.
            $table->boolean('is_working')->default(true); //Si hay alguien trabajando en el taller.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feet');
    }
};

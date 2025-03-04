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
        Schema::create('components', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre del componente
            $table->unsignedInteger('views'); //clics que ha tenido el componente
            $table->text('html_code'); // Código HTML
            $table->text('css_code')->nullable(); // Clases de Tailwind o CSS puro
            $table->text('js_code')->nullable(); // Código JS si es necesario
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('components');
    }
};

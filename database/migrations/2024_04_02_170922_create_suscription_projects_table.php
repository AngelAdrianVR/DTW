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
        Schema::create('suscription_projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedMediumInteger('subscribers_quantity')->nullable();
            $table->unsignedFloat('public_price')->nullable();
            $table->unsignedTinyInteger('plans_quantity');
            $table->string('status');
            $table->timestamp('release_date'); //Fecha en la que se lanzó al mercado
            $table->text('description');
            $table->foreignId('responsible_id')->nullable()->constrained('users')->cascadeOnDelete(); //usuario responsable de ese proyecto (no obligatorio)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suscription_projects');
    }
};

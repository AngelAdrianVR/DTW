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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('key');
            $table->text('description');
            $table->string('hours_work');
            $table->json('customer_info')->nullable(); //name, email, company, phone. attributes in message model 
            $table->date('start_date')->nullable();
            $table->date('finish_date')->nullable();
            $table->string('state')->default('En revisión');
            $table->unsignedFloat('price');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

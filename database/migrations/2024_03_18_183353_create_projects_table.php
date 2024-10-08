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
            $table->boolean('internal_project')->default(false);
            $table->string('key')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('category');
            $table->text('description')->nullable();
            $table->string('hours_work');
            $table->unsignedTinyInteger('total_work_days')->nullable();
            $table->json('customer_info')->nullable(); //name, email, company, phone. attributes in message model 
            $table->date('start_date')->nullable();
            $table->date('estimated_date')->nullable();
            $table->date('finish_date')->nullable();
            $table->string('state')->default('En revisión');
            $table->boolean('invoice')->default(false);
            $table->unsignedFloat('price')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('responsible_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('client_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('quote_id')->nullable()->constrained()->onDelete('cascade');
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

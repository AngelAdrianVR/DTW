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
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name')->default('Cliente');
            $table->string('company')->nullable();
            $table->string('company_address')->nullable();
            $table->string('project')->nullable();
            $table->string('email')->nullable();
            $table->json('included_features')->nullable();
            $table->json('suggested_features')->nullable();
            $table->unsignedMediumInteger('percentage_discount')->nullable();
            $table->unsignedMediumInteger('total_work_days')->nullable();
            $table->unsignedTinyInteger('advance_payment_percentage')->default(50);
            $table->unsignedMediumInteger('total_cost');
            $table->unsignedSmallInteger('total_hours');
            $table->date('promised_end_date');
            $table->unsignedTinyInteger('offer_validity_days')->default(30);
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};

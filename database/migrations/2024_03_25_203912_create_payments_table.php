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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->enum('billing_type', ['UNDEFINED', 'PIX', 'BOLETO', 'CREDIT_CARD'])->default('UNDEFINED');
            $table->float('value');
            $table->date('due_date');
            $table->string('description')->nullable();
            $table->integer('days_after_due_date_to_registration_cancellation')->nullable();
            $table->string('external_reference')->nullable();
            $table->integer('installment_count')->nullable();
            $table->float('total_value')->nullable();
            $table->float('installment_value')->nullable();
            $table->json('discount')->nullable();
            $table->json('interest')->nullable();
            $table->json('fine')->nullable();
            $table->boolean('postal_service')->nullable();
            $table->json('split')->nullable();
            $table->json('callback')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

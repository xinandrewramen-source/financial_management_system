<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payer_id')->constrained('payers')->onDelete('cascade');
            $table->string('invoice_number')->unique();
            $table->enum('ar_category', ['BOUNDARY', 'CORPORATE_BILLING', 'CASH_ADVANCE', 'INSURANCE_CLAIM', 'OTHER']);
            $table->decimal('total_amount', 10, 2);
            $table->decimal('paid_amount', 10, 2)->default(0.00);
            $table->enum('status', ['UNPAID', 'PARTIAL', 'PAID', 'CANCELLED'])->default('UNPAID');
            $table->date('due_date');
            $table->string('paymongo_link_id')->nullable();
            $table->string('paymongo_checkout_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
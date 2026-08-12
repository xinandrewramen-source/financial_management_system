<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->decimal('total_amount', 15, 2)->change();
            $table->decimal('paid_amount', 15, 2)->default(0.00)->change();
        });

        Schema::table('collections', function (Blueprint $table) {
            $table->decimal('amount_collected', 15, 2)->change();
        });
    }

    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->decimal('total_amount', 10, 2)->change();
            $table->decimal('paid_amount', 10, 2)->default(0.00)->change();
        });

        Schema::table('collections', function (Blueprint $table) {
            $table->decimal('amount_collected', 10, 2)->change();
        });
    }
};

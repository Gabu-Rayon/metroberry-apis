<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('maintenance_repair_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('maintenance_repair_id')->constrained('maintenance_repairs');
            $table->foreignId('vehicle_id')->constrained('vehicles');
            $table->foreignId('part_id')->constrained('vehicle_parts');
            $table->string('repair_type');
            $table->decimal('repair_cost', 10, 2);
            $table->foreignId('invoice_id');
            $table->foreignId('account_id');
            $table->string('receipt_type_code');
            $table->string('payment_type_code');
            $table->date('confirm_date')->nullable();
            $table->date('payment_date')->nullable();
            $table->decimal('total_taxable', 10, 2);
            $table->decimal('amount', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->text('remark')->nullable();
            $table->string('payment_receipt')->nullable();
            $table->string('reference')->nullable();
            $table->string('qr_code_url')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_repair_payments');
    }
};
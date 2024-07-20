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
        Schema::create('maintenance_service_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('maintenance_service_id')->constrained('maintenance_services');
            $table->foreignId('vehicle_id')->constrained('vehicles');
            $table->foreignId('service_type_id')->constrained('service_types');
            $table->foreignId('service_category_id')->constrained('service_type_categories');
            $table->date('service_date');
            $table->decimal('service_cost', 10, 2);
            $table->foreignId('invoice_id');
            $table->foreignId('account_id')->nullable()->constrained('accounts');
            $table->string('receipt_type_code')->nullable();
            $table->string('payment_type_code')->nullable();
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
        Schema::dropIfExists('maintenance_service_payments');
    }
};
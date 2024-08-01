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
        Schema::create('vehicle_refueling_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('refueling_station_id');
            $table->unsignedBigInteger('vehicle_id');
            $table->string('invoice_no')->unique();
            $table->unsignedBigInteger('account_id');
            $table->string('receipt_type_code');
            $table->string('payment_type_code');
            $table->timestamp('confirm_date')->nullable();
            $table->timestamp('payment_date')->nullable();
            $table->decimal('total_taxable_amount', 15, 2);
            $table->decimal('total_tax_amount', 15, 2);
            $table->decimal('total_amount', 15, 2);
            $table->text('remark')->nullable();
            $table->string('payment_receipt')->nullable();
            $table->string('reference')->nullable();
            $table->string('qr_code_url')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->timestamps();

            $table->foreign('refueling_station_id')->references('id')->on('refuelling_stations')->onDelete('cascade');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_refueling_payments');
    }
};

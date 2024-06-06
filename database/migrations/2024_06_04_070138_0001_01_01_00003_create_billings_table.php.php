<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::create('billings_invoices', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('trip_id');
        //     $table->unsignedBigInteger('customer_id');
        //     $table->string('invoice_no');
        //     $table->string('customer_tin');
        //     $table->string('customer_name');
        //     $table->string('receipt_type_code');
        //     $table->string('payment_type_code');
        //     $table->string('sales_status_code');
        //     $table->date('confirm_date');
        //     $table->date('sales_date');
        //     $table->date('cancel_request_date')->nullable();
        //     $table->string('refund_reason_code')->nullable();
        //     $table->float('total_taxable_amount');
        //     $table->float('total_tax_amount');
        //     $table->float('total_amount');
        //     $table->text('remark');
        //     $table->string('qr_code_url');
        //     $table->timestamps();

        //     $table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade');
        //     $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billings_invoices');
    }
};
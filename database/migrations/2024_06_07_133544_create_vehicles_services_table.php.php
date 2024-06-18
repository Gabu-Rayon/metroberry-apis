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
        Schema::create('vehicle_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicle_id');
            $table->string('servicing_company_name');
            $table->text('servicing_company_address');
            $table->string('servicing_company_contact');
            $table->string('servicing_company_email')->nullable();
            $table->boolean('servicing_done')->default(false);
            $table->text('total_repairs');
            $table->float('total_repairs_costs');
            $table->string('payment_type_code');
            $table->string('invoice_no');
            $table->string('company_invoice_no');
            $table->date('servicing_date');
            $table->string('invoice_qr_code_url');
            $table->unsignedBigInteger('created_by');
            $table->timestamps();

            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_services');
    }
};
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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('username');
            $table->string('email')->unique();
            $table->foreignId('organisation_id')->constrained('organisations');
            $table->string('customer_organisation_code');
            $table->string('contact');
            $table->string('home_address');
            $table->string('password');
            $table->string('avatar')->nullable(); 
            $table->boolean('is_email_verified')->default(false); 
            $table->boolean('is_contact_verified')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
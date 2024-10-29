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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');  // Foreign key to users
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('company_name');
            $table->string('company_logo')->nullable();
            $table->string('company_details');
            $table->string('signature');
            $table->string('banking_details');
            $table->string('number');
            $table->string('email');
            $table->string('payment_frequency')->nullable();
            $table->decimal('amount', 10, 2)->default(0);
            $table->date('last_payment_date')->nullable();
            $table->date('next_payment_due')->nullable();
            $table->timestamps(); 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade'); // Added client_id
            $table->string('invoice_type');
            $table->integer('invoice_number')->unique(); // Ensure invoice number is unique
            $table->string('bill_to');
            $table->string('ship_to');
            $table->date('date'); // Changed to date type for better handling of date values
            $table->integer('qty');
            $table->string('description')->nullable();
            $table->decimal('unit_price', 10, 2)->nullable(); // Added unit price
            $table->decimal('amount', 10, 2)->nullable(); 
            $table->decimal('subtotal', 10, 2)->nullable(); // Added subtotal
            $table->decimal('total_amount', 10, 2); 
            $table->date('due_date')->nullable();
            $table->text('signature')->nullable();
            $table->text('terms_and_conditions')->nullable();
            $table->enum('status', ['paid', 'unpaid', 'overdue'])->default('unpaid');
            $table->timestamps(); // This adds created_at and updated_at fields
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}

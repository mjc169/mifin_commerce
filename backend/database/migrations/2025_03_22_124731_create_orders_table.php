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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // Nullable for guest orders
            $table->string('name')->nullable(); // Customer Name
            $table->string('email')->nullable(); // Customer Email
            $table->string('address')->nullable(); // Customer Address
            $table->string('city')->nullable(); // Customer City
            $table->string('state')->nullable(); // Customer State/Province
            $table->string('zip')->nullable(); // Customer Zip/Postal Code
            $table->decimal('total_amount', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title');
            $table->text('short_description')->nullable();
            $table->enum('availability', ['In Stock', 'Out Of Stock'])->default('In Stock');
            $table->string('brand')->nullable();
            $table->string('sku')->unique();
            $table->decimal('price', 10, 2);
            $table->string('color')->nullable();
            $table->string('material')->nullable();
            $table->json('pictures')->nullable(); // Store multiple pictures as JSON
            $table->json('tags')->nullable(); // Store tags as JSON
            $table->text('long_description')->nullable();
            $table->json('specification')->nullable(); // Dynamic key-value pairs for specifications
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->string('amazon_link')->nullable();
            $table->string('insta_link')->nullable();
            $table->softDeletes(); // Add soft delete column
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

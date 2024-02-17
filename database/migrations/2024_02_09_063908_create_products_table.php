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
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('menu_id')->nullable()->references('id')->on('menus')->onDelete('set null');
            $table->string('title');
            $table->string('slug');
            $table->text('short_description')->nullable();
            $table->integer('stock')->default(0);
            $table->string('brand')->nullable();
            $table->string('sku')->nullable();
            $table->decimal('regular_price', 10, 2)->nullable();
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->text('colors')->nullable();
            $table->text('materials')->nullable();
            $table->string('cover_img')->nullable(); // Store multiple pictures as JSON
            $table->text('pictures')->nullable(); // Store multiple pictures as JSON
            $table->longText('tags')->nullable(); // Store tags as JSON
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

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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('url');
            $table->string('menu_type')->nullable();
            $table->string('image')->nullable();
            $table->string('size')->nullable();
            $table->boolean('visibility')->default(true);
            $table->string('page_title')->nullable();
            $table->text('meta_desc')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('menus');
            $table->timestamps();
        });

        // New table for menu items
//        Schema::create('menu_items', function (Blueprint $table) {
//            $table->id();
//            $table->string('label');
//            $table->string('url');
//            $table->foreignId('menu_id')->constrained('menus');
//            $table->foreignId('parent_id')->nullable()->constrained('menu_items');
//            $table->timestamps();
//        });

        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('url');
            $table->foreignId('menu_id')->constrained('menus');
            $table->foreignId('parent_id')->nullable()->constrained('menu_items');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};

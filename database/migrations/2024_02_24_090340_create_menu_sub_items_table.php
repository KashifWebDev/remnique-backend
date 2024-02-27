<?php

use App\Models\MenuSubItem;
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
        Schema::create('menu_sub_items', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('url');
            $table->foreignIdFor(MenuSubItem::class, 'parent_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_sub_items');
    }
};

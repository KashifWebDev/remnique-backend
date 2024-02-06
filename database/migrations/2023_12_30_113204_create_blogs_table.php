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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('blog_categories', 'id');
            $table->string('title', 255);
            $table->string('slug', 255)->unique();
            $table->string('description', 255)->nullable();
            $table->string('cover_image')->nullable();
            $table->text('content');
            $table->enum('status', array('draft', 'publish'))->index();
            $table->json('tags')->nullable();
            $table->boolean('featured')->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};

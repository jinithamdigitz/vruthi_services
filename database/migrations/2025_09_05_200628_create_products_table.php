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

            // basic fields
            $table->string('name');
            $table->text('description')->nullable();
            
            $table->string('image')->nullable();

            // foreign key to categories (assuming you already have product_categories table)
            $table->foreignId('product_category_id')
            ->constrained('product_categories')
            ->cascadeOnDelete();

            $table->timestamps(); // created_at & updated_at
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

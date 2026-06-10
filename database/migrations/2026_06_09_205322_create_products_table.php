<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->restrictOnDelete();
            $table->string('name');                           // ej: Cappuccino, Croissant de Mantequilla
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();   // para tarjetas del catálogo
            $table->decimal('base_price', 10, 2);            // precio base
            $table->string('sku')->unique()->nullable();
            $table->string('thumbnail')->nullable();         // imagen principal
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);  // destacado en home
            $table->boolean('is_available')->default(true);  // disponible hoy (agotado temporal)
            $table->boolean('allow_customization')->default(false); // permite extras/modificadores
            $table->integer('preparation_time')->default(5); // minutos estimados de preparación
            $table->integer('sort_order')->default(0);
            $table->unsignedInteger('views_count')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index('category_id');
            $table->index('is_active');
            $table->index('is_featured');
            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

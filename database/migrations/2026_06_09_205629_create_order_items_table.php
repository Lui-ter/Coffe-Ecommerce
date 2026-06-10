<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();

            // Snapshot del producto al momento de ordenar
            $table->string('product_name');
            $table->string('product_sku')->nullable();
            $table->unsignedInteger('quantity');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('modifiers_price', 10, 2)->default(0.00); // total de modificadores
            $table->decimal('total_price', 10, 2);                    // (unit + modifiers) * qty

            $table->text('special_instructions')->nullable();

            $table->json('selected_modifiers')->nullable();
            /*
             * Misma estructura que cart_items.selected_modifiers.
             * Se almacena como snapshot para mantener historial exacto
             * aunque los precios del menú cambien en el futuro.
             */

            $table->timestamps();

            $table->index('order_id');
            $table->index('product_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};

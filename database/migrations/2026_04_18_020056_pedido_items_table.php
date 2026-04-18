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
        Schema::create('pedido_items', function (Blueprint $table) {
            $table->id();
            // FK al pedido; si se elimina el pedido, se eliminan sus ítems
            $table->foreignId('pedido_id')
                  ->constrained('pedidos')
                  ->onDelete('cascade');
            // FK al SKU comprado; se usa restrictedDelete para no borrar SKUs
            // con historial de ventas accidentalmente
            $table->foreignId('producto_sku_id')
                  ->constrained('producto_skus')
                  ->onDelete('restrict');
            $table->integer('cantidad')->unsigned();
            /**
             * Precio unitario en CENTAVOS al momento de la compra.
             * IMPORTANTE: Este valor es un snapshot histórico.
             * No debe actualizarse aunque cambie el precio actual del SKU,
             * para preservar la integridad del registro contable.
             */
            $table->integer('precio_unitario')->unsigned();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedido_items');
    }
};

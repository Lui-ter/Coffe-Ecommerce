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
            $table->id('pedidoitem_codigo');
            // FK al pedido; si se elimina el pedido, se eliminan sus ítems
            $table->unsignedBigInteger('pedido_id');
            $table->foreign('pedido_id')
                  ->references('pedido_codigo')
                  ->on('pedidos')
                  ->onDelete('cascade');
            // FK al SKU comprado; se usa restrictedDelete para no borrar SKUs
            // con historial de ventas accidentalmente
            $table->unsignedBigInteger('productosku_id');
            $table->foreign('productosku_id')
                  ->references('productosku_codigo')
                  ->on('producto_skus')
                  ->onDelete('cascade');
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

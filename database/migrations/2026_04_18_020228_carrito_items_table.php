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
        Schema::create('carrito_items', function (Blueprint $table) {
            $table->id('carritoitem_codigo');
            // FK al usuario dueño del carrito
            $table->foreignId('user_id')
                  ->constrained('usuarios')
                  ->onDelete('cascade');
            // FK al SKU agregado al carrito
            $table->foreignId('producto_sku_id')
                  ->constrained('producto_skus')
                  ->onDelete('cascade');
            $table->integer('cantidad')->unsigned()->default(1);
            $table->timestamps();

            // Un usuario no puede tener el mismo SKU duplicado en su carrito;
            // si lo agrega dos veces, se actualiza la cantidad en el controlador.
            $table->unique(['user_id', 'producto_sku_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carrito_items');
    }
};

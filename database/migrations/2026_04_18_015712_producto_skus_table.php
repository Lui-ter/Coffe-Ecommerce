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
        Schema::create('producto_skus', function (Blueprint $table) {
            $table->id();
            // FK al producto padre; si se elimina el producto, se eliminan todos sus SKUs
            $table->foreignId('producto_id')
                  ->constrained('productos')
                  ->onDelete('cascade');
            // Código único de referencia (ej: "HUI-ESP-1LB-MED-Grano")
            $table->string('sku', 100)->unique();
            // Peso en libras como decimal para permitir valores como 0.5, 1, 2, 5
            $table->decimal('peso_libras', 5, 2);
            // Nivel de tueste (ej: 'Claro', 'Medio', 'Oscuro', 'Espresso')
            $table->string('nivel_tueste', 50);
            // Tipo de molienda (ej: 'Grano Entero', 'Espresso', 'Filtro', 'Prensa Francesa')
            $table->string('tipo_molienda', 80);
            /**
             * Precio almacenado en CENTAVOS (entero) para evitar problemas
             * de precisión con decimales en cálculos monetarios.
             * Ejemplo: $18.500 COP se almacena como 1850000 (si se usa COP)
             *          $12.99 USD se almacena como 1299
             */
            $table->integer('precio')->unsigned();
            // Cantidad de unidades disponibles en inventario
            $table->integer('stock_disponible')->unsigned()->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('producto_skus');
    }
};

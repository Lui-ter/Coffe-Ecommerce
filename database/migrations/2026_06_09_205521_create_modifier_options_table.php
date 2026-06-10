<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Opciones dentro de cada grupo de modificadores.
     * Ejemplos para grupo "Tamaño":
     *   - Pequeño  → +$0.00
     *   - Mediano  → +$1.500
     *   - Grande   → +$3.000
     */
    public function up(): void
    {
        Schema::create('modifier_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('modifier_group_id')->constrained()->cascadeOnDelete();
            $table->string('name');                          // ej: "Grande", "Leche de avena"
            $table->decimal('price_adjustment', 8, 2)->default(0.00); // precio adicional
            $table->string('sku')->nullable();
            $table->boolean('is_default')->default(false);  // opción seleccionada por defecto
            $table->boolean('is_available')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index('modifier_group_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modifier_options');
    }
};

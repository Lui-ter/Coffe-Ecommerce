<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Grupos de modificadores para personalización de productos.
     * Ejemplos:
     *   - Tamaño: Pequeño | Mediano | Grande
     *   - Temperatura: Frío | Caliente
     *   - Leche: Entera | Deslactosada | Vegetal | Avena
     *   - Extras: Shot extra | Crema chantilly | Sirope de vainilla
     */
    public function up(): void
    {
        Schema::create('modifier_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');                          // ej: "Tamaño", "Tipo de leche"
            $table->string('display_name');                  // nombre visible al cliente
            $table->enum('selection_type', ['single', 'multiple'])->default('single');
            // single   = solo puede elegir 1 (ej: tamaño)
            // multiple = puede elegir varios (ej: extras)
            $table->boolean('is_required')->default(false);
            $table->integer('min_selections')->default(0);
            $table->integer('max_selections')->default(1);
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modifier_groups');
    }
};

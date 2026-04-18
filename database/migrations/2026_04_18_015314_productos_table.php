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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            // FK a la categoría; si se elimina la categoría, se eliminan sus productos
            $table->foreignId('categoria_id')
                  ->constrained('categorias')
                  ->onDelete('cascade');
            $table->string('nombre', 150);
            // Slug único para URLs amigables (ej: "huila-especial-lavado")
            $table->string('slug', 180)->unique();
            $table->text('descripcion')->nullable();
            // Ruta relativa a la imagen principal (ej: "productos/huila-especial.jpg")
            $table->string('ruta_imagen')->nullable();
            // País o región de origen del café (ej: "Huila, Colombia")
            $table->string('origen', 100)->nullable();
            // Altitud de cultivo en metros sobre el nivel del mar
            $table->string('altura', 50)->nullable();
            // Perfil de sabor / notas de cata (ej: "Chocolate, Caramelo, Frutos Rojos")
            $table->string('notas_cata', 255)->nullable();
            // Permite desactivar un producto del catálogo sin eliminarlo
            $table->boolean('esta_activo')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};

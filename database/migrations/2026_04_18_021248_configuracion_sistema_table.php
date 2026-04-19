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
        Schema::create('configuracion_sistema', function (Blueprint $table) {
            $table->id('configuracion_codigo');
            // Clave única del parámetro (ej: 'whatsapp_numero')
            $table->string('clave', 100)->unique();
            // Valor del parámetro; longText para soportar mensajes largos
            $table->longText('valor')->nullable();
            // Descripción legible para el administrador en el panel
            $table->string('descripcion', 255)->nullable();
            // Grupo lógico para agrupar settings en el panel (ej: 'whatsapp', 'wompi', 'tienda')
            $table->string('grupo', 50)->default('general')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('configuracion_sistema');
    }
};

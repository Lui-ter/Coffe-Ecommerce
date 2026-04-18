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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('email')->unique();
            $table->timestamp('email_verificado_en')->nullable();
            $table->string('contrasena');
            // Teléfono con formato internacional para integración con WhatsApp
            $table->string('telefono', 20)->nullable();
            // Rol del usuario dentro del sistema: 'cliente' o 'administrador'
            $table->enum('rol', ['cliente', 'administrador'])->default('cliente');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('tokens_reset_contrasena', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('creado_en')->nullable();
        });

        Schema::create('sesiones', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('ultima_actividad')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sesiones');
        Schema::dropIfExists('tokens_reset_contrasena');
        Schema::dropIfExists('usuarios');
    }
};

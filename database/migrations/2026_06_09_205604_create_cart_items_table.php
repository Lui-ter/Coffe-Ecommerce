<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('session_id')->nullable();        // carrito de usuario no autenticado
            $table->string('customer_name')->nullable();     // nombre para el pedido WA
            $table->string('customer_phone', 20)->nullable();// WhatsApp del cliente
            $table->enum('status', ['active', 'converted', 'abandoned'])->default('active');
            $table->timestamp('expires_at')->nullable();     // TTL del carrito (ej: 2 horas)
            $table->timestamps();

            $table->index('user_id');
            $table->index('session_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};

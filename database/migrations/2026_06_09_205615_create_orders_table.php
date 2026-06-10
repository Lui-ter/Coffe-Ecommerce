<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();        // ej: CAF-20240615-0042
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('cart_id')->nullable()->constrained()->nullOnDelete();

            // ── Datos del cliente (snapshot al momento del pedido) ──────────────
            $table->string('customer_name');
            $table->string('customer_phone', 20);            // número WhatsApp confirmado
            $table->string('customer_email')->nullable();

            // ── Tipo de pedido ───────────────────────────────────────────────────
            $table->enum('order_type', ['pickup', 'delivery', 'dine_in'])->default('pickup');
            // pickup   = para recoger en cafetería
            // delivery = domicilio (futuro)
            // dine_in  = mesa en el local

            $table->string('table_number')->nullable();      // si es dine_in
            $table->text('delivery_address')->nullable();    // si es delivery

            // ── Totales ──────────────────────────────────────────────────────────
            $table->decimal('subtotal', 10, 2);
            $table->decimal('discount_amount', 10, 2)->default(0.00);
            $table->decimal('delivery_fee', 10, 2)->default(0.00);
            $table->decimal('total', 10, 2);

            // ── Estado del pedido ────────────────────────────────────────────────
            $table->enum('status', [
                'pending',          // recibido, esperando confirmación del staff
                'confirmed',        // confirmado por la cafetería vía WA
                'preparing',        // en preparación
                'ready',            // listo para recoger / entregar
                'delivered',        // entregado al cliente
                'cancelled',        // cancelado
            ])->default('pending');

            // ── WhatsApp ─────────────────────────────────────────────────────────
            $table->text('whatsapp_message')->nullable();    // mensaje generado y enviado a WA
            $table->timestamp('whatsapp_sent_at')->nullable();
            $table->string('whatsapp_status')->nullable();   // sent | delivered | read | failed

            // ── Notas ────────────────────────────────────────────────────────────
            $table->text('customer_notes')->nullable();      // observaciones del cliente
            $table->text('staff_notes')->nullable();         // notas internas del staff

            // ── Tiempos estimados ─────────────────────────────────────────────────
            $table->integer('estimated_time')->nullable();   // minutos estimados de preparación
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('ready_at')->nullable();
            $table->timestamp('delivered_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('order_number');
            $table->index('user_id');
            $table->index('status');
            $table->index('order_type');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

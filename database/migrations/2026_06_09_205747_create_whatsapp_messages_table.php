<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Log de todos los mensajes de WhatsApp generados / enviados.
     * Permite rastrear el historial de comunicación con el cliente.
     *
     * Flujo WA:
     *  1. Cliente llena el carrito y confirma pedido.
     *  2. El sistema genera un mensaje de texto formateado con el resumen.
     *  3. Se redirige al cliente a wa.me/{numero_cafeteria}?text={mensaje_codificado}
     *  4. El cliente envía el mensaje desde su WhatsApp.
     *  5. El staff recibe el pedido en WhatsApp y actualiza el estado.
     */
    public function up(): void
    {
        Schema::create('whatsapp_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->string('recipient_phone', 20);           // número de la cafetería
            $table->string('sender_phone', 20)->nullable();  // número del cliente
            $table->text('message_content');                 // texto completo del mensaje
            $table->string('wa_link')->nullable();           // link wa.me generado
            $table->enum('direction', ['outgoing', 'incoming'])->default('outgoing');
            // outgoing = mensaje que el sistema genera para que el cliente envíe
            // incoming = respuestas del staff (registro manual futuro)
            $table->enum('status', ['generated', 'opened', 'sent', 'failed'])->default('generated');
            // generated = link creado
            // opened    = cliente abrió el link de WA
            // sent      = confirmado manualmente que llegó
            $table->timestamp('sent_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index('order_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('whatsapp_messages');
    }
};

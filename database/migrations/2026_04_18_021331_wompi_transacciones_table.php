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
        Schema::create('wompi_transacciones', function (Blueprint $table) {
            $table->id();

            // ── Relación con el pedido ────────────────────────────────
            // FK al pedido asociado. Se usa SET NULL para conservar el registro
            // de la transacción incluso si el pedido fuera eliminado por error.
            $table->unsignedBigInteger('pedido_id');
            $table->foreign('pedido_id')
                  ->references('pedido_codigo')
                  ->on('pedidos')
                  ->onDelete('cascade');

            // ── Identificadores de Wompi ──────────────────────────────
            // ID único de la transacción asignado por Wompi (ej: "257494-1697554321-72352")
            $table->string('wompi_id', 100)->unique();
            /**
             * Referencia que enviamos a Wompi al iniciar el pago.
             * Debe coincidir con 'numero_pedido' en la tabla 'pedidos'.
             * Wompi la devuelve en el webhook para que identifiquemos el pedido.
             */
            $table->string('referencia', 60)->index();

            // ── Estado de la transacción (devuelto por Wompi) ─────────
            // Valores posibles: 'PENDING' | 'APPROVED' | 'DECLINED' | 'VOIDED' | 'ERROR'
            $table->string('estado', 20);

            // ── Datos financieros ─────────────────────────────────────
            /**
             * Monto en CENTAVOS tal como lo reporta Wompi.
             * Wompi trabaja nativamente en centavos de la moneda.
             * Ejemplo: $50.000 COP = 5000000 centavos.
             */
            $table->bigInteger('monto_en_centavos')->unsigned();
            // Moneda de la transacción (ej: 'COP', 'USD')
            $table->string('moneda', 10)->default('COP');

            // ── Método de pago ────────────────────────────────────────
            // Tipo de medio de pago (ej: 'CARD', 'PSE', 'BANCOLOMBIA_TRANSFER', 'NEQUI')
            $table->string('tipo_pago', 50)->nullable();
            // Últimos 4 dígitos de la tarjeta (solo si aplica)
            $table->string('ultimos_cuatro', 4)->nullable();
            // Franquicia de la tarjeta (ej: 'VISA', 'MASTERCARD')
            $table->string('franquicia', 30)->nullable();

            // ── Trazabilidad y auditoría ──────────────────────────────
            /**
             * Payload JSON completo recibido en el webhook de Wompi.
             * Se guarda íntegro para depuración, auditoría y reprocesamiento
             * en caso de fallo en la actualización del pedido.
             */
            $table->json('payload_webhook')->nullable();
            /**
             * Firma del webhook recibida en el header 'X-Event-Checksum'.
             * Se guarda para auditoría; la validación se hace comparando
             * SHA256(payload_concatenado + llave_eventos_wompi).
             */
            $table->string('firma_webhook', 255)->nullable();
            // Fecha y hora exacta en que Wompi reportó el evento
            $table->timestamp('fecha_transaccion_wompi')->nullable();

            $table->timestamps();

            // Índice para consultar rápido todas las transacciones de un pedido
            $table->index(['pedido_id', 'estado']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wompi_transacciones');
    }

};

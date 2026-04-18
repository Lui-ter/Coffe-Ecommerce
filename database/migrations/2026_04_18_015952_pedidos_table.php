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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            // FK al usuario que realizó el pedido
            $table->foreignId('user_id')
                  ->constrained('usuarios')
                  ->onDelete('cascade');
            // Número legible y único para mostrar al cliente (ej: "CAF-20240115-0042")
            $table->string('numero_pedido', 60)->unique();
            /**
             * Monto total del pedido en CENTAVOS (entero).
             * Misma estrategia que 'precio' en producto_skus para evitar
             * errores de redondeo flotante en operaciones financieras.
             */
            $table->integer('monto_total')->unsigned();
            // Estado del ciclo de vida del pedido como string para mayor legibilidad
            $table->string('estado', 20)->default('pendiente');
            // 'pendiente' | 'pagado' | 'enviado' | 'entregado' | 'cancelado'
            // Método de pago utilizado (ej: 'wompi', 'transferencia', 'contraentrega')
            $table->string('metodo_pago', 50)->nullable();
            /**
             * ID o referencia de la transacción devuelta por Wompi (o pasarela similar).
             * Se usa para conciliar pagos y atender disputas.
             */
            $table->string('id_transaccion_pago', 150)->nullable();
            // Dirección de envío capturada al momento del pedido (snapshot)
            $table->text('direccion_envio')->nullable();
            // Teléfono de contacto para coordinar entrega vía WhatsApp
            $table->string('telefono_contacto', 20)->nullable();
            // Instrucciones especiales del cliente (ej: "Dejar en portería")
            $table->text('notas')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};

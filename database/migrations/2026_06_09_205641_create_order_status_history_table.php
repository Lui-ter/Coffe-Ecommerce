<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Historial de cambios de estado de cada pedido.
     * Permite auditar cuándo pasó cada cosa y quién lo hizo.
     */
    public function up(): void
    {
        Schema::create('order_status_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete(); // staff que cambió
            $table->string('from_status')->nullable();
            $table->string('to_status');
            $table->text('notes')->nullable();               // razón del cambio (ej: "cliente canceló")
            $table->string('changed_by')->nullable();        // nombre del staff o "sistema"
            $table->timestamps();

            $table->index('order_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_status_history');
    }
};

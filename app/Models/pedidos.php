<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pedidos extends Model
{
    protected $table = 'pedidos';
    protected $primaryKey = 'pedido_codigo';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'numero_pedido',
        'monto_total',
        'estado',
        'metodo_pago',
        'id_transaccion_pago',
        'direccion_envio',
        'telefono_contacto',
        'notas'
    ];

    const ESTADO_PENDIENTE  = 'pendiente';
    const ESTADO_PAGADO     = 'pagado';
    const ESTADO_ENVIADO    = 'enviado';
    const ESTADO_ENTREGADO  = 'entregado';
    const ESTADO_CANCELADO  = 'cancelado';

    // ─── Relaciones ───────────────────────────────────────────

    // Un pedido pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(user::class, 'user_id', 'id');
    }

    // Un pedido tiene muchos items (detalle del pedido)
    public function items()
    {
        return $this->hasMany(pedidos_items::class, 'pedido_id', 'pedido_codigo');
    }

    // Verifica si el pedido puede ser cancelado
    public function cancelable(): bool
    {
        return in_array($this->estado, [
            self::ESTADO_PENDIENTE,
            self::ESTADO_PAGADO
        ]);
    }
}

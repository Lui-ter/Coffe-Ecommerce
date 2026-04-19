<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pedidos_items extends Model
{
    protected $table = 'pedido_items';
    protected $primaryKey = 'pedidoitem_codigo';
    public $timestamps = true;

    protected $fillable = [
        'pedido_id',
        'producto_sku_id',
        'cantidad',
        'precio_unitario'
    ];

    // ─── Relaciones ───────────────────────────────────────────

    // Un item pertenece a un pedido
    public function pedido()
    {
        return $this->belongsTo(pedidos::class, 'pedido_id', 'pedido_codigo');
    }

    // Un item apunta al SKU comprado (snapshot histórico del precio)
    public function sku()
    {
        return $this->belongsTo(productos_skus::class, 'producto_sku_id', 'productosku_codigo');
    }

}

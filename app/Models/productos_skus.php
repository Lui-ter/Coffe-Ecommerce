<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class productos_skus extends Model
{
    protected $table = 'producto_skus';
    protected $primaryKey = 'productosku_codigo';
    public $timestamps = true;

    protected $fillable = [
        'producto_id',
        'sku',
        'peso_libras',
        'nivel_tueste',
        'tipo_molienda',
        'precio',
        'stock_disponible'
    ];

    // Un SKU pertenece a un producto padre
    public function producto()
    {
        return $this->belongsTo(productos::class, 'producto_id', 'producto_codigo');
    }

    // Helper: convierte centavos a pesos para mostrar en vistas
    public function getPrecioFormateadoAttribute(): string
    {
        return '$' . number_format($this->precio / 100, 0, ',', '.');
    }
}

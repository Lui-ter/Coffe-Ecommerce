<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'producto_codigo';
    public $timestamps = false;

    protected $fillable = [
        'categoria_id',
        'nombre',
        'slug',
        'descripcion'
    ];

    // Un producto pertenece a una categoría
    public function categoria()
    {
        return $this->belongsTo(categorias::class, 'categoria_id', 'categoria_codigo');
    }
    // Un producto tiene muchos SKUs
    public function skus()
    {
        return $this->hasMany(productos_skus::class, 'producto_id', 'producto_codigo');
    }
}

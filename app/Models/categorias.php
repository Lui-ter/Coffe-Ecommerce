<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    protected $table = 'categorias';
    protected $primaryKey = 'categoria_codigo';
    public $timestamps = true; // ✅ coincide con la migración

    protected $fillable = [
        'nombre',
        'slug',
        'descripcion'
    ];

    public function productos()
    {
        return $this->hasMany(productos::class, 'categoria_id', 'categoria_codigo');
    }
}

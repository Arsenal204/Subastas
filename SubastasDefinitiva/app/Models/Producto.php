<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $fillable = [
        'nombre', 'descripcion', 'precio_base', 'estado', 'stock', 'categoria_id'
    ];

    public function subastas()
    {
        return $this->belongsToMany(Subasta::class, 'producto_subasta');
    }


    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}


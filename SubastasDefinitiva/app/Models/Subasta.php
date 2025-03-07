<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subasta extends Model
{
    use HasFactory;
    protected $table = 'subastas';
    protected $fillable = [
        'user_id', 'precio_inicial', 'precio_actual',
        'fecha_inicio', 'fecha_fin', 'estado'
    ];

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'productos_subasta');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pujas()
    {
        return $this->hasMany(Puja::class);
    }
}


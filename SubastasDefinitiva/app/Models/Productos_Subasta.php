<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Productos_Subasta extends Model
{
    use HasFactory;
    protected $table = 'productos_subasta';
    protected $fillable = ['producto_id', 'subastass_id'];

    public function productos() {
        return $this->belongsTo(Producto::class);
    }

    public function subastas() {
        return $this->belongsTo(Subasta::class);
    }
}

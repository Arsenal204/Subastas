<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Productos_Subasta extends Model
{
    use HasFactory;
    protected $table = 'producto_subasta';
    protected $fillable = ['producto_id', 'subasta_id'];
    
    public function producto() {
        return $this->belongsTo(Producto::class);
    }
    
    public function subasta() {
        return $this->belongsTo(Subasta::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class Pago extends Model
{
    use HasFactory;
    protected $fillable = ['usuario_id', 'subasta_id', 'monto', 'estado', 'metodo_pago', 'transaccion_id'];
    
    public function usuario() {
        return $this->belongsTo(User::class);
    }
    
    public function subasta() {
        return $this->belongsTo(Subasta::class);
    }
}

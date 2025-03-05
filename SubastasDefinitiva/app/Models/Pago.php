<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pago extends Model
{
    use HasFactory;
    protected $table = 'pagos';
    protected $fillable = ['user_id', 'subasta_id', 'monto', 'estado', 'metodo_pago', 'transaccion_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function subastas() {
        return $this->belongsTo(Subasta::class);
    }
}

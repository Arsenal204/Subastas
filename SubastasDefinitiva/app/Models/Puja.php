<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Puja extends Model
{
    use HasFactory;
    protected $fillable = ['subasta_id', 'usuario_id', 'monto', 'es_ganadora', 'autopuja'];
    
    public function subasta() {
        return $this->belongsTo(Subasta::class);
    }
    
    public function usuario() {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Puja extends Model
{
    use HasFactory;
    protected $table = 'pujas';
    protected $fillable = ['subasta_id', 'user_id', 'monto', 'es_ganadora', 'autopuja'];

    public function subastas() {
        return $this->belongsTo(Subasta::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}

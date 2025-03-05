<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comentario extends Model
{
    use HasFactory;
    protected $table = 'comentarios';
    protected $fillable = ['user_id', 'subasta_id', 'comentario', 'valoracion', 'moderado'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function subastas() {
        return $this->belongsTo(Subasta::class);
    }
}

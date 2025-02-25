<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comentario extends Model
{
    use HasFactory;
    protected $table = 'comentario';
    protected $fillable = ['usuario_id', 'subasta_id', 'comentario', 'valoracion', 'moderado'];
    
    public function usuario() {
        return $this->belongsTo(User::class);
    }
    
    public function subasta() {
        return $this->belongsTo(Subasta::class);
    }
}

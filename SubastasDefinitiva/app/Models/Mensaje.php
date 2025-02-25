<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mensaje extends Model
{
    use HasFactory;
    protected $table = 'mensaje';
    protected $fillable = ['emisor_id', 'receptor_id', 'mensaje', 'leido', 'tipo'];
    
    public function emisor() {
        return $this->belongsTo(User::class, 'emisor_id');
    }
    
    public function receptor() {
        return $this->belongsTo(User::class, 'receptor_id');
    }
}

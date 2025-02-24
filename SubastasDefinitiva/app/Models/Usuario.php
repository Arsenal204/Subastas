<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'correo', 'contrasenia', 'rol', 'saldo'];
    
    public function subastas() {
        return $this->hasMany(Subasta::class);
    }
    
    public function pujas() {
        return $this->hasMany(Puja::class);
    }
    
    public function pagos() {
        return $this->hasMany(Pago::class);
    }
    
    public function comentarios() {
        return $this->hasMany(Comentario::class);
    }
    
    public function mensajesEnviados() {
        return $this->hasMany(Mensaje::class, 'emisor_id');
    }
    
    public function mensajesRecibidos() {
        return $this->hasMany(Mensaje::class, 'receptor_id');
    }
}

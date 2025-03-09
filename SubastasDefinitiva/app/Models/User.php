<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use Billable;


    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     * 
     * 
     */
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'rol',
        'saldo',
        'imagen',
        'stripe_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
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

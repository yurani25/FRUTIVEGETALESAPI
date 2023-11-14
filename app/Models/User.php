<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class user extends Authenticatable

{

    protected $fillable = [
        'nombres' ,
        'apellidos',
        'edad',
        'telefono',
        'email',
        'password',
        'profile_picture',
        'rol_id', 
        'abastecimiento_id'
        
    ];
    

    use HasFactory;
    
    // Relacion Uno a Muchos 
    public function mensajes(){
        return $this->hasMany('App\Models\mensaje');
    }
    public function pqrs()
    {
        return $this->hasMany('App\Models\pqr');
    }

    public function productos()
    {
        return $this->hasMany('App\Models\producto');
    }
    public function carritoCompras()
    {
        return $this->hasMany('App\Models\carrito_compra');
    }

    public function compras()
    {
        return $this->hasMany('App\Models\compra');
    }

    public function abastecimiento()
    {
        return $this->belongsTo('App\Models\abastecimiento');
    }

    public function rol()
    {
        return $this->belongsTo('App\Models\rol');
    }
    public function pagos()
    {
        return $this->hasMany('App\Models\pago');
    }
}

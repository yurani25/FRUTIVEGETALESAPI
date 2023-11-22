<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mensaje extends Model
{

    protected $fillable = [
        'user_id',
        'nombr_chat' 
    ];

    use HasFactory;
    //Relacion Uno a Muchos (Inversa) con user
    public function users(){
        return $this->belongsTo('App\Models\user');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class abastecimiento extends Model
{
    protected $fillable = [
        'nombre',
        'ubicacion ' ,
        'horario_atencion'

    ];

    use HasFactory;
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}

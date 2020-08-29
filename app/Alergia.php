<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
MODELO QUE GESTIONA LOS DATOS DE LA TABLA ALERGIAS
*/
class Alergia extends Model
{
    //campos de la tabla alergias
    protected $fillable = [
        'id', 'nombre', 'tipo'
    ];

    //Hace referencia al nombre que esta en la base de datos
    protected $table = 'alergias';

    //Le dices a laravel que esta tabla no contiene los campos created_at y updated_at
    public $timestamps = false;

}

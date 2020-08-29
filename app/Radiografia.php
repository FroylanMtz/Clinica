<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
MODELO QUE GESTIONA LA TABLA DE LA RADIOGRAFIA
*/
class Radiografia extends Model
{
    //campos que sera usados por el modelo al momento de realizar los cruds
    protected $fillable = [
        'id', 'ruta', 'tipo'
    ];

    //nombre exacto de la tabla en la bd
    protected $table = 'archivos';

    //Le dices a laravel que esta tabla no contiene los campos created_at y updated_at
    public $timestamps = false;

}

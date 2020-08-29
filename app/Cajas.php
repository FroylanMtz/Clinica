<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/*
MODELO QUE GESTIONA LA TABLA CAJAS EN LA BASE DE DATOS
*/
class Cajas extends Model
{
    //
    //hace referencia a la tabla de pagos 
    protected $fillable = [
        'id', 'total', 'f_apertura', 'f_cierre'
    ];

    //nombre de la tabla en la bd
    protected $table = 'cajas';

    //Le dices a laravel que esta tabla no contiene los campos created_at y updated_at
    public $timestamps = false;
}

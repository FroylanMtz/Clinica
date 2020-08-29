<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/*
MODELO QUE GESTIONA LA TABLA DE PAGOS EN LA BASE DE DATOS
*/
class Pagos extends Model
{
    //campos que seran usuado por el modulo al momento de realizar los CRUD 
     protected $fillable = [
        'id', 'fecha', 'total', 'detalles', 'tipo', 'estado'
    ];

    //nombre exacto de la tabla en la bd
    protected $table = 'pagos';

    //Le dices a laravel que esta tabla no contiene los campos created_at y updated_at
    public $timestamps = false;
}

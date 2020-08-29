<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
MODELO QUE GESTIONA LA TABLA MEDICAMENTOS EN LA BASE DE DATOS
*/
class Medicamento extends Model
{
    //campos que seran usados por el modelo
    protected $fillable = [
        'id', 'nombre', 'presentacion', 'detalles'
    ];

    //nombre exacto del nombre de la tabla en la bd
    protected $table = 'medicina';

    //Le dices a laravel que esta tabla no contiene los campos created_at y updated_at
    public $timestamps = false;
}

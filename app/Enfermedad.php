<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


/*
MODELO QUE GESTIONA LA TABLA ENFERMEDADES EN LA BASE DE DATOS
*/
class Enfermedad extends Model
{
    use Notifiable;

    //Campos que seran usado por el modelo
    protected $fillable = [
        'id', 'nombre', 'tipo', 'causa'
    ];

    //nombre de la tabla en la bd
    protected $table = 'enfermedades';
}

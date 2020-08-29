<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/*
MODELO QUE SE ENCARGA DE LA GESTION DE LA TABLA PACIENTES EN LA BASE DE DATOS
*/
class Paciente extends Model
{
    //
    use Notifiable;
    //campos que seran usados por el modlo, (campos de la tabla)
    protected $fillable = [
        'id', 'nombre', 'apellido', 'edad', 'altura', 'peso', 'sexo', 'fecha_nacimiento', 'foto'
    ];

    //nombre exacto de la tabla en la bd
    protected $table = 'paciente';

    //Le dices a laravel que esta tabla no contiene los campos created_at y updated_at
    public $timestamps = false;
}

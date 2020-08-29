<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/*
MODELO QUE GESTIONA LA TABLE CITAS
*/
class Cita extends Model
{
    use Notifiable;

    protected $guarded = [];

    //Campos que se relacionan con la tabla
    protected $fillable = [
        'id', 'fecha', 'hora','detalles','id_enfermedad', 'doctor_id', 'paciente_id', 'pago', 'observaciones'
    ];

    //nombre de la tabla en la base de datos
    protected $table = 'citas';

    //Le dices a laravel que esta tabla no contiene los campos created_at y updated_at
    public $timestamps = false;

}

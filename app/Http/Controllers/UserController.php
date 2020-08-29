<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::latest()->paginate(10);
        //return 'Prueba de funcionamiento';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
 
        return User::create([
             'name' => $request['name'],
             'last_name' => $request['lastName'],
             'email' => $request['email'],
             'tipo' => $request['type'],
             'password' => Hash::make($request['password']),
        ]);
        return "correcto";
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request)
    {
        $user = User::findOrFail( $request->id );
        $user->update($request->all());
        return ['message' => 'updated'];

        //return $request;
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return ['message' => 'data deleted'];
    }

    public function doctores()
    {
        return User::all()->where('tipo', '=', '2');
    }

    //Obtiene los medicos asociados de la tabla usuarios, el tipo es el numero 3
    public function medicosAsociadoas()
    {
        return User::all()->where('tipo', '=', '3');
    }

    //Obtiene los registros de la tabla donde se realiza el compartido de un expediente a un medico asociado
    public function obtenerComparticiones(){

        return DB::table('paciente_usuarios')
            ->join('users AS u', 'u.id', '=', 'paciente_usuarios.id_usuario')
            ->join('users AS ma', 'ma.id', '=', 'paciente_usuarios.medico_asociado')
            ->join('paciente AS p', 'p.id', '=', 'paciente_usuarios.id_paciente')
            ->select('paciente_usuarios.id', 'paciente_usuarios.fecha', 'paciente_usuarios.info', 'paciente_usuarios.alergias', 'paciente_usuarios.enfermedades', 'paciente_usuarios.medicinas' ,'u.name AS nombreMedico', 'u.last_name AS apellidoMedico', 'u.id AS idMedico',
                     'ma.name AS nombreAsociado', 'ma.last_name AS apellidoAsociado', 'ma.id AS idAsociado',
                     'p.nombre', 'p.apellido' , 'p.id AS pacienteId')
            ->get();
    }

    //Realiza el guardado de un registro en la comparticion de expedientes
    public function guardarComparticion( Request $request ){
        DB::table('paciente_usuarios')->insert(
            ['id_usuario' => $request->doctor_id,
             'medico_asociado' => $request->doctor_asociado,
             'id_paciente' => $request->id_paciente,
             'fecha' => date('Y-m-d'),
             'info' => $request->info,
             'alergias' => $request->alergias,
             'enfermedades' => $request->enfermedades,
             'medicinas' => $request->medicamentos ]
        );

        return $request;
    }

    //Elimina una comparticion de un expediente
    public function eliminarComparticion($id){
        DB::table('paciente_usuarios')->where('id', '=', $id)->delete();
    }

    //Obtiene las alergias de un paciente en especifico
    public function obtenerAlergiasPaciente($id){
        return DB::table('paciente_alergias')
            ->join('alergias', 'alergias.id', '=', 'paciente_alergias.id_alergia')
            ->select('alergias.nombre AS nombreAlergia', 'alergias.tipo AS tipoAlergia', 'paciente_alergias.*')
            ->where('paciente_alergias.id_paciente', '=', $id)
            ->get();
    }

    //Obtiene todas las enfermedades de un paciente en especifico
    public function obtenerEnfermedadesPaciente($id){
        return DB::table('citas')
            ->join('enfermedades', 'enfermedades.id', '=', 'citas.id_enfermedad')
            ->select('enfermedades.*', 'citas.*')
            ->where('citas.paciente_id', '=', $id)
            ->get();
    }

    //Obtiene todos los medicos recetados a un paciente en especifico
    public function obtenerMedicamentosPaciente($id){
        return DB::table('cita_medicina')
            ->join('citas', 'citas.id', '=', 'cita_medicina.id_cita')
            ->join('medicina', 'medicina.id', '=', 'cita_medicina.id_medicina')
            ->select('citas.*', 'citas.id AS id_cita' ,'medicina.*', 'cita_medicina.observaciones')
            ->where('citas.paciente_id', '=', $id)
            ->get();
    }



}

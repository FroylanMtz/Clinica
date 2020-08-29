<?php

namespace App\Http\Controllers;


use App\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class PacientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Paciente::all();
    }


    //Obtiene los registros de pacientes que fueron compartidos definiendolo por el id
    public function obtenerPacientesExpediente($id)
    {
        return DB::table('paciente')
            ->join('paciente_usuarios', 'paciente_usuarios.id_paciente', '=', 'paciente.id')
            ->select('paciente_usuarios.*', 'paciente.*')
            ->where('paciente_usuarios.medico_asociado', '=', $id)
            ->get();
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
        //
        return Paciente::create([
            'nombre' => $request['nombre'],
            'apellido' => $request['apellido'],
            'edad' => $request['edad'],
            'altura' => $request['altura'],
            'peso' => $request['peso'],
            'sexo' => $request['sexo'],
            'fecha_nacimiento' => $request['fecha_nacimiento']
        ]);


       return "correcto";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //SE ACTUALIZAN
        $paciente = Paciente::findOrFail( $request->id );
        $paciente->update($request->all());
        return ['message' => 'updated'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //eliminar el registro
        $paciente = Paciente::findOrFail($id);
        $paciente->delete();
        return ['message' => 'data deleted'];
    }
    //recibir info del paciente
    Public function info($id){
        return Paciente::where('id',$id)->first();
    }
}

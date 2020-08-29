<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Cita;
use App\Enfermedad;
use App\Paciente;

class DashboardController extends Controller
{
    
    public function obtenertotalusuarios(){
        $usuarios = User::all();
        return count($usuarios);
    }

    public function obtenertotalcitas(){
        $citas = Cita::all();
        return count($citas);
    }

    public function obtenertotalenfermedades(){
        $enfermedades = Enfermedad::all();
        return count( $enfermedades );
    }

    public function obtenertotalpacientes(){
        $pacientes = Paciente::all();
        return count($pacientes);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

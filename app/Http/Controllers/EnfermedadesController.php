<?php

namespace App\Http\Controllers;
use App\Enfermedad;
use Illuminate\Http\Request;
use DB;

class EnfermedadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        //return "Prueba de enfermedades controller en el metodo index";
        return Enfermedad::all();
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
        return Enfermedad::create([
            'nombre' => $request['nombre'],
            'tipo' => $request['tipo'],
            'causa' => $request['causa']
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
        //

        $enfermedad = Enfermedad::findOrFail( $request->id );
        $enfermedad->update($request->all());
        return ['mensaje' => 'registro actualizado correctamente'];
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
        $enfermedad = Enfermedad::findOrFail($id);
        $enfermedad->delete();
        return ['mensjae' => 'registro de enfermedad eliminado'];
    }

    //Se encarga del guardado de un padecimiento en la cita
    public function padecimiento(Request $request)
    {

        $affected = DB::table('citas')
              ->where('id', $request->id)
              ->update(['id_enfermedad' => $request->idpadecimiento, 'observaciones' => $request->observaciones]);


        return $request;

    }
}

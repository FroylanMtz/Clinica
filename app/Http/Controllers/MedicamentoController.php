<?php

namespace App\Http\Controllers;

use App\Medicamento;
use Illuminate\Http\Request;
use DB;

class MedicamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Medicamento::all();;
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
        return Medicamento::create([
            'nombre' => $request['nombre'],
            'presentacion' => $request['presentacion'],
            'detalles' => $request['detalles'],
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
        $medicamento = Medicamento::findOrFail( $request->id );
        $medicamento->update($request->all());
        return ['mensaje' => 'registro actualizado'];
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
        $medicamento = Medicamento::findOrFail($id);
        $medicamento->delete();
        return ['mensaje' => 'registro eliminado'];
    }


    //Almacena un medicamento a una cita en especifico dada por el objeto request
    public function medicamento(Request $request)
    {
        DB::table('cita_medicina')->where('id_cita', '=', $request->id_cita)->delete();
        
        for ($i=0; $i < sizeof($request->medicamentos); $i++) { 
            DB::table('cita_medicina')->insert(
                ['id_cita' => $request->id_cita, 
                 'id_medicina' => $request->medicamentos[$i]['id'],
                 'observaciones' => $request->medicamentos[$i]['observaciones'] ]
            );
        }

        return $request;
    }

    //Guarda los medicamentos en una cita en especifido dada por el id pasado como parametro
    public function medicamentosCita($id){
        $medicamentos = DB::table('cita_medicina')
            ->join('medicina', 'medicina.id', '=', 'cita_medicina.id_medicina')
            ->select('medicina.*', 'cita_medicina.*')
            ->where('cita_medicina.id_cita', '=', $id)
            ->get();
        return $medicamentos;
    }
}

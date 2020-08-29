<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alergia;

class AlergiasController extends Controller
{
    //Obtiene todas las alergias registradas en la base de datos
    public function index() {
        return Alergia::all();
    }

    //Funcion que realiza el guardado de una alergia pasandole como parametro un objeto tipo request
    public function store(Request $request){
        return Alergia::create([
            'nombre' => $request['nombre'],
            'tipo' => $request['tipo'],
        ]);
       return "correcto";
    }
    
    //Funcion que permite realizar la actualizacion de un alergia
    public function update(Request $request){    
        $alergia = Alergia::findOrFail( $request->id );
        $alergia->update($request->all());
        return ['mensaje' => 'registro actualizado'];
    }

    //Funcion para eliminar una alegria
    public function destroy($id)
    {
        //
        $alergia = Alergia::findOrFail($id);
        $alergia->delete();
        return ['mensaje' => 'registro eliminado'];
    }
}

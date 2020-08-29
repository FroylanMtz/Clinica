<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use App\Radiografia;
use File;
use DB;

class RadiografiasController extends Controller
{

    public function index(){

        return DB::table('usuario_archivo')
            ->join('users AS m', 'm.id', '=', 'usuario_archivo.id_usuario')
            ->join('users AS a', 'a.id', '=', 'usuario_archivo.medico_asociado')
            ->join('archivos', 'archivos.id', '=', 'usuario_archivo.id_archivo')
            ->select('m.name as nombreMedico', 'm.last_name as apellidoMedico',
                     'a.name as nombreAsociado', 'a.last_name as apellidoAsociado',
                     'archivos.ruta', 'usuario_archivo.comentario', 'archivos.id')
            ->get();

    }

    public function store(Request $request){

        if($request->get('image')){
          $image = $request->get('image');
          $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
          \Image::make($request->get('image'))->save(public_path('images/').$name);
        }

        $image = new Radiografia();
        $image->ruta = $name;
        $image->tipo = "imagen";
        $image->save();

        DB::table('usuario_archivo')->insert(
            ['id_archivo' => $image->id, 
             'id_usuario' => $request->medico,
             'medico_asociado' => $request->asociado]
        );

        return response()->json(['success' => 'se ha guardado la imagen'], 200);

    }

    public function destroy($id)
    {
        //

        $radiografia = Radiografia::findOrFail($id);
        $radiografia->delete();
        return ['mensaje' => 'radiografia eliminada'];
        
        //return $id;
    }

    public function obtenerRadiografiasCompartidas($id)
    {
        return DB::table('usuario_archivo')
            ->join('users AS m', 'm.id', '=', 'usuario_archivo.id_usuario')
            ->join('users AS a', 'a.id', '=', 'usuario_archivo.medico_asociado')
            ->join('archivos', 'archivos.id', '=', 'usuario_archivo.id_archivo')
            ->select('m.name as nombreMedico', 'm.last_name as apellidoMedico',
                     'a.name as nombreAsociado', 'a.last_name as apellidoAsociado',
                     'archivos.ruta', 'usuario_archivo.id as id_usuario_archivo' ,'usuario_archivo.comentario', 'archivos.id')
            ->where('usuario_archivo.medico_asociado', '=', $id)
            ->get();

    }

    public function guardarComentarioRadiografia( Request $request ){

        DB::table('usuario_archivo')
              ->where('id', $request->id )
              ->update(['comentario' => $request->comentario ]);

        return $request;
    }

}

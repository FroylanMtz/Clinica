<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cita;
use App\Http\Resources\CalendarResource;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

use DB;

class CitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return CalendarResource::collection(Cita::all());
    }


    public function obtenerDatosCita($id){
        //Union de tablas
        return $citasdehoy = DB::table('citas')
            ->join('paciente', 'paciente.id', '=', 'citas.paciente_id')
            ->select('citas.*', 'paciente.*')
            ->where('citas.id','=', $id)
            ->get();
    }

    public function citasDeHoy($id)
    {
        $hoy = date('Y-m-d');
        //$citasdehoy = DB::table('citas')->where(DB::raw('DATE(fecha)'), $hoy)->get();

        if( $id == 0 ){
            $citasdehoy = DB::table('citas')
                ->join('users', 'users.id', '=', 'citas.doctor_id')
                ->join('paciente', 'paciente.id', '=', 'citas.paciente_id')
                ->select('citas.*', 'users.name as nombredoctor', 'users.last_name as apellidodoctor', 'paciente.nombre', 'paciente.apellido')
                ->where(DB::raw('DATE(fecha)'),'=', $hoy)
                ->get();
        }else {
            $citasdehoy = DB::table('citas')
                ->join('users', 'users.id', '=', 'citas.doctor_id')
                ->join('paciente', 'paciente.id', '=', 'citas.paciente_id')
                ->select('citas.*', 'users.name as nombredoctor', 'users.last_name as apellidodoctor', 'paciente.nombre', 'paciente.apellido')
                ->where(DB::raw('DATE(fecha)'),'=', $hoy)
                ->where('citas.doctor_id', '=', $id )
                ->get();
        }

        
        return $citasdehoy;
        //select * from test where DATE(date) = '2014-03-19';

    }

    public function obtenerCitas($id)
    {
        //$citas = DB::table('citas')->get();
        //<>

        $hoy = date('Y-m-d');

        if( $id == 0 ){
            $citas = DB::table('citas')
                ->join('users', 'users.id', '=', 'citas.doctor_id')
                ->join('paciente', 'paciente.id', '=', 'citas.paciente_id')
                ->select('citas.*', 'users.name as nombredoctor', 'users.last_name as apellidodoctor', 'paciente.nombre', 'paciente.apellido')
                ->where(DB::raw('DATE(fecha)'),'<>', $hoy)
                ->get();
        }else {
            $citas = DB::table('citas')
                ->join('users', 'users.id', '=', 'citas.doctor_id')
                ->join('paciente', 'paciente.id', '=', 'citas.paciente_id')
                ->select('citas.*', 'users.name as nombredoctor', 'users.last_name as apellidodoctor', 'paciente.nombre', 'paciente.apellido')
                ->where(DB::raw('DATE(fecha)'),'<>', $hoy)
                ->where('citas.doctor_id', '=', $id )
                ->get();
        }

        return $citas;
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
        $new_calendar = Cita::create($request->all());

        return response()->json([
            'data' => new CalendarResource($new_calendar),
            'message' => 'Successfully added new event!',
            'status' => Response::HTTP_CREATED
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cita $cita)
    {
        //
        return response($cita, Response::HTTP_OK);
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
        $cita = Cita::findOrFail( $request->id );
        $cita->update($request->all());
        return ['mensaje' => 'cita actualizada correctamente'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();
        return ['message' => 'data deleted'];
    }
    //metodo para guardar la alergia elegida
    public function alergia(Request $request){
        //eliminar las alergias del paciente
        DB::table('paciente_alergias')->where('id_paciente', '=', $request->id)->delete();
        
        for ($i=0; $i < sizeof($request->ids); $i++) { 
            DB::table('paciente_alergias')->insert(
                ['id_paciente' => $request->id, 'id_alergia' => $request->ids[$i]]
            );
        }
    }
    //para no eliminar las alergias que ya se habias elccionad en la cita, no perder el registro
    public function alergiaPaciente($id){
        $users = DB::table('paciente_alergias')
            ->join('alergias', 'alergias.id', '=', 'paciente_alergias.id_alergia')
            ->select('alergias.*')
            ->where('paciente_alergias.id_paciente', '=', $id)
            ->get();
        return $users;
    }
}

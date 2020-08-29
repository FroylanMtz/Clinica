<?php

namespace App\Http\Controllers;

use App\Pagos;
use App\Cajas;
use App\Cita;
use DB;
use Illuminate\Http\Request;

class PagosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //obtener los regitros de la tabla
        return Pagos::all();
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
        //ir aumentando el total de las citas (dinero)
        $caja=Cajas::where('f_cierre', null)->first();
        $total=$caja->total+$request['total'];
        $caja->update(['total'=>$total]);
        //guardar datos
        $pagoTotal=Pagos::create([
            'fecha' => $request['fecha'],
            'total' => $request['total'],
            'detalles' => $request['detalles'],
            'tipo' => $request['tipo']
        ]);
        DB::table('caja_pago')->insert(
            ['id_caja' => $caja->id, 'id_pago' => $pagoTotal->id]
        );

        //Relacionar el pago con la cita
        $cita = Cita::findOrFail( $request->cita );
        $cita->pago = $pagoTotal->id;
        $cita->save();

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
        //obtener los valores antweriores del pago
        $pagoAnterior=Pagos::findOrFail($request->id);

        //obtener la caja abierta actual
        $caja=Cajas::where('f_cierre', null)->first();
        //se elimina el pago equivocado y se suma el nuevo modificado con lo que ya se tenia en caja
        $caja->total=$caja->total-$pagoAnterior->total;
        $caja->total=$caja->total+$request->total;
        //se guarda los cambios
        $caja->save();
        //SE ACTUALIZAN LOS DATOS A LOS NUEVO
        $pago = Pagos::findOrFail( $request->id );
        $pago->update($request->all());


        //Actualiza la relacion con la cita
        $cita = Cita::findOrFail( $request->id_cita );
        $cita->pago = $pago->id;
        $cita->save();

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
        //obtener los valores antweriores del pago
        $pagoAnterior=Pagos::findOrFail($id);
        //obtener la caja abierta actual
        $caja=Cajas::where('f_cierre', null)->first();

        //se resta el valor del registro a eliminar con el dinero que se tiene en la caja hasta el momento
        $caja->total=$caja->total-$pagoAnterior->total;
        //se guarda los cambios
        $caja->save();
        //elimir la relacion del pago con la caja
        DB::table('caja_pago')->where('id_caja', '=', $caja->id)->where('id_pago', '=', $id)->delete();

        //eliminar el registro
        $pago = Pagos::findOrFail($id);
        $pago->delete();
        return ['message' => 'data deleted'];
    }
}

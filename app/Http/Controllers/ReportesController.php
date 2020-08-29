<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use DB;

class ReportesController extends Controller
{

    public function generarReporteCitas($id){
        //$pdf = PDF::loadView('pdf.cita', ['id' => $id] );
        //return $pdf->download('reporte_cita_'. $id .'.pdf');

        $cita = DB::table('citas')
            ->select('citas.*')
            ->where('citas.id', '=', $id)
            ->get();

        $doctor = DB::table('citas')
            ->join('users', 'users.id', '=', 'citas.doctor_id')
            ->select('users.*')
            ->where('citas.id', '=', $id)
            ->get();
        
        $paciente = DB::table('citas')
            ->join('paciente', 'paciente.id', '=', 'citas.paciente_id')
            ->select('paciente.*')
            ->where('citas.id', '=', $id)
            ->get();
            
        $enfermedad = DB::table('citas')
            ->join('enfermedades', 'enfermedades.id', '=', 'citas.id_enfermedad')
            ->select('enfermedades.*')
            ->where('citas.id', '=', $id)
            ->get();

        $medicamento = DB::table('citas')
            ->join('cita_medicina', 'cita_medicina.id_cita', '=', 'citas.id')
            ->join('medicina', 'medicina.id', '=', 'cita_medicina.id_medicina')
            ->select('medicina.*', 'cita_medicina.*')
            ->where('citas.id', '=', $id)
            ->get();

        //return view('pdf.cita', ['id' => $id, 'cita' => $cita, 'enfermedad' => $enfermedad, 'medicamento' => $medicamento, 'paciente' => $paciente, 'doctor' => $doctor ]);

        $pdf = PDF::loadView('pdf.cita', ['id' => $id, 'cita' => $cita, 'enfermedad' => $enfermedad, 'medicamento' => $medicamento, 'paciente' => $paciente, 'doctor' => $doctor ] );
        return $pdf->download('reporte_cita_'. $id .'.pdf');
    }

    public function generarReporteExpediente($id){
        $pdf = PDF::loadView('pdf.expediente', ['id' => $id] );
        return $pdf->download('reporte_expediente_'. $id .'.pdf');
    }

    public function generarReportePago($id){

        $doctor = DB::table('citas')
            ->join('users', 'users.id', '=', 'citas.doctor_id')
            ->select('users.*')
            ->where('citas.pago', '=', $id)
            ->get();

        $pago = DB::table('pagos')
            ->select('pagos.*')
            ->where('pagos.id', '=', $id)
            ->get();

        $cita = DB::table('citas')
            ->select('citas.*')
            ->where('citas.pago', '=', $id)
            ->get();

        $pdf = PDF::loadView('pdf.pago', ['id' => $id, 'pago' => $pago, 'cita' => $cita, 'doctor' => $doctor] );
        return $pdf->download('reporte_pago_'. $id .'.pdf');

        //return view('pdf.pago', ['id' => $id, 'pago' => $pago, 'cita' => $cita, 'doctor' => $doctor]);
    }


}

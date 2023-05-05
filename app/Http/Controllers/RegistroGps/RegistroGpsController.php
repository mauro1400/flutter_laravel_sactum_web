<?php

namespace App\Http\Controllers\RegistroGps;

use App\Http\Controllers\Controller;
use App\Models\gps_registros;
use App\Models\Transporte;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistroGpsController extends Controller
{
    public function registroGPS(Request $request)
    {
        try {
            DB::beginTransaction();
            $id_persona = $request->input('id_persona');

            $id_transporte = Transporte::select('transportes.id_transporte')
                ->join('chofers', 'transportes.id_chofer', '=', 'chofers.id_chofer')
                ->join('personas', 'chofers.id_persona', '=', 'personas.id_persona')
                ->where('personas.id_persona', '=', $id_persona)
                ->get()
                ->first()->id_transporte;

            $gps_registro = new gps_registros();
            $gps_registro->id_transporte = $id_transporte;
            $gps_registro->lat = $request->input('latitud');
            $gps_registro->lng = $request->input('longitud');
            $gps_registro->registro = Carbon::now();
            $gps_registro->estado = 1;
            $gps_registro->save();
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Ubicacion saved successfully',
                'gps_registro' => $gps_registro,
            ], 200);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function enviarUbicacion(Request $request)
    {
        try {

            //$id_persona = $request->input('id_persona');
            $id_persona = 6;
            DB::beginTransaction();
            $gps_registros=gps_registros::select('lat', 'lng', 'registro')
            ->where('id_transporte', function ($query) use ($id_persona) {
                $query->select('transportes.id_transporte')
                    ->from('transportes')
                    ->join('chofers', 'transportes.id_chofer', '=', 'chofers.id_chofer')
                    ->join('personas', 'chofers.id_persona', '=', 'personas.id_persona')
                    ->where('personas.id_persona', $id_persona);
            })
            ->orderByDesc('id_gps_registro')
            ->limit(1)
            ->get();
        
            
            return response()->json([
                'status' => 'success',
                'message' => 'Ubicacion Enviada',
                'data' => $gps_registros,
            ], 200);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
}

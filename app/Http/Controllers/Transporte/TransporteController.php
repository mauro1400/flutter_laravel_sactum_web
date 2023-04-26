<?php

namespace App\Http\Controllers\Transporte;

use App\Http\Controllers\Controller;
use App\Models\Transporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransporteController extends Controller
{
    public function index()
    {
        try {
            DB::beginTransaction();
            $transporte = Transporte::all();
            DB::commit();

            if (!$transporte) {
                return response()->json([
                    'success' => false,
                    'message' => 'Transportes no encontrados.',
                ]);
            }

            return response()->json([
                'success' => true,
                'transporte' => $transporte,
            ]);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }


    public function insertarTransporte(Request $request)
    {
        try {
            DB::beginTransaction();

            $transporte = new Transporte();
            $transporte->id_chofer = $request->input('id_chofer');
            $transporte->modelo = $request->input('modelo');
            $transporte->placa = $request->input('placa');
            $transporte->estado = $request->input('estado');
            $transporte->cant_persona = $request->input('cant_persona');
            $transporte->descripcion = $request->input('descripcion');

            $transporte->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Transporte insertado con éxito. ID de Transporte: ' . $transporte->id_transporte . ', ID de Chofer: ' . $transporte->id_chofer,
            ]);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function eliminarTransporte($id_transporte)
    {
        try {
            DB::beginTransaction();

            $transporte = Transporte::where('id_transporte', $id_transporte)->first();
            $transporte->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Registro eliminado con éxito.',
            ]);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function editarTransporte($id_transporte)
    {
        try {
            DB::beginTransaction();
            // Buscar al transporte
            $transporte = Transporte::findOrFail($id_transporte);

            DB::commit();

            if (!$transporte) {
                return response()->json([
                    'success' => false,
                    'message' => 'Estudiante no encontrado.',
                ]);
            }

            return response()->json([
                'success' => true,
                'transporte' => $transporte,
            ]);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
    public function actualizarTransporte(Request $request, $id_transporte)
    {
        try {
            DB::beginTransaction();

            // Buscar al estudiante a actualizar
            $transporte = Transporte::where('id_transporte', $id_transporte)->first();
            if (!$transporte) {
                throw new \Exception('Transporte no encontrado.');
            }
            $transporte->id_chofer = $request->input('id_chofer');
            $transporte->modelo = $request->input('modelo');
            $transporte->placa = $request->input('placa');
            $transporte->estado = $request->input('estado');
            $transporte->cant_persona = $request->input('cant_persona');
            $transporte->descripcion = $request->input('descripcion');
            $transporte->save();


            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Registro actualizado con éxito.',
            ]);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
}

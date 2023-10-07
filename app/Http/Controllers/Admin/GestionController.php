<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gestion;

class GestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       try {
            $listarGestion = Gestion::select('gestions.id_gestion', 'gestions.gestion', 'gestions.periodo', 'gestions.descripcion_gestion')
            ->where('gestions.estado', 1)
            ->orderBy('id_gestion')
            ->get();       
            return response()->json([
                'listarGestion' => $listarGestion
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $gestions = new Gestion();
            $gestions->gestion = $request->input('gestion');
            $gestions->periodo = $request->input('periodo');
            $gestions->descripcion_gestion = $request->input('descripcion_gestion');
            $gestions->estado = 1;                        
            $gestions->save();                       
            return response()->json([
                'success' => true,
                'message' => 'Gestion insertado con éxito. ID de Gestion: ' . $gestions->id_gestion,
            ]);        
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_gestion)
    {
        try {            
            // Buscar al transporte
            $gestion = Gestion::findOrFail($id_gestion);
            if (!$gestion) {
                return response()->json([
                    'success' => false,
                    'message' => 'gestion no encontrado.',
                ]);
            }
            return response()->json([
                'success' => true,
                'gestion' => $gestion,
            ]);
        } catch (\Throwable $th) {           
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
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
        try {
            // Buscar al estudiante a actualizar            
            //$grado = Grado::where('id_grado', $request->id_grado)->first();
            $gestion = Gestion::find($request->id_gestion);
            if (!$gestion) {
                throw new \Exception('Grado no encontrado.');
            }
            //$grado->id_grado = $request->input('id_grado');
            $gestion->gestion = $request->input('gestion');    
            $gestion->periodo = $request->input('periodo');
            $gestion->descripcion_gestion = $request->input('descripcion_gestion');    
            $gestion->save();
            return response()->json([
                'success' => true,
                'message' => 'Registro actualizado con éxito.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminargestion($id_gestion) 
    {
        try {
            // Buscar al estudiante a actualizar            
            //$grado = Grado::where('id_grado', $request->id_grado)->first();
            $gestion = Gestion::find($id_gestion);
            if (!$gestion) {
                throw new \Exception('Gestion no encontrado.');
            }
            //$grado->id_grado = $request->input('id_grado');
            $gestion->estado = 0;    
            $gestion->save();
            return response()->json([
                'success' => true,
                'message' => 'Registro eliminado con éxito.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grado;

class GradoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       try {
            $listaGrados = Grado::select('grados.id_grado', 'grados.grado')
            ->where('grados.estado', 1)
            ->orderBy('id_grado')
            ->get();       
            return response()->json([
                'listaGrados' => $listaGrados
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
            $grado = new Grado();
            $grado->grado = $request->input('grado');
            $grado->estado = 1;                        
            $grado->save();                       
            return response()->json([
                'success' => true,
                'message' => 'Grado insertado con éxito. ID de Grado: ' . $grado->id_grado,
            ]);        
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
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
    public function edit($id_grado)
    {
        try {            
            // Buscar al transporte
            $grado = Grado::findOrFail($id_grado);
            if (!$grado) {
                return response()->json([
                    'success' => false,
                    'message' => 'grado no encontrado.',
                ]);
            }
            return response()->json([
                'success' => true,
                'grado' => $grado,
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
            $grado = Grado::find($request->id_grado);
            if (!$grado) {
                throw new \Exception('Grado no encontrado.');
            }
            //$grado->id_grado = $request->input('id_grado');
            $grado->grado = $request->input('grado');    
            $grado->save();
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
    public function eliminargrado($id_grado) 
    {
        //try {
            // Buscar al estudiante a actualizar            
            //$grado = Grado::where('id_grado', $request->id_grado)->first();
            $grado = Grado::find($id_grado);
            if (!$grado) {
                throw new \Exception('Grado no encontrado.');
            }
            //$grado->id_grado = $request->input('id_grado');
            $grado->estado = 0;    
            $grado->save();
            return response()->json([
                'success' => true,
                'message' => 'Registro eliminado con éxito.',
            ]);
        /*} catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }*/
    }
}

<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    public function informacionUsuario($id){
        
            try {
                DB::beginTransaction();
                // Buscar al transporte
                $usuario = User::findOrFail($id);
    
                DB::commit();
    
                if (!$usuario) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Usuario no encontrado.',
                    ]);
                }
    
                return response()->json([
                    'success' => true,
                    'usuario' => $usuario,
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

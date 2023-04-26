<?php

namespace App\Http\Controllers\Chofer;

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Controller;
use App\Models\Chofer;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PersonaChoferController extends Controller
{
    public function index()
    {
        $listaChoferes = Chofer::join('personas', 'personas.id_persona', '=', 'chofers.id_persona')
            ->select(
                'personas.id_persona',
                'personas.nombres',
                'personas.primer_apellido',
                'personas.segundo_apellido',
                'personas.ci',
                'personas.fecha_nacimiento',
                'personas.genero',
                'personas.direccion',
                'personas.celular as cel',
                'chofers.celular',
                'chofers.pin'
            )
            ->get();
        return response()->json([
            'listaChoferes' => $listaChoferes
        ]);
    }

    public function insertarPersonaChofer(Request $request)
    {
        try {
            DB::beginTransaction();
            $persona = new Persona();
            $persona->nombres = $request->input('p_nombres');
            $persona->primer_apellido = $request->input('p_primer_apellido');
            $persona->segundo_apellido = $request->input('p_segundo_apellido');
            $persona->ci = $request->input('p_ci');
            $persona->fecha_nacimiento = $request->input('p_fecha_nacimiento');
            $persona->genero = $request->input('p_genero');
            $persona->direccion = $request->input('p_direccion');
            $persona->celular = $request->input('p_celular');
            $persona->save();

            // Insertar en la tabla choferes
            $chofer = new Chofer();
            $chofer->id_persona = $persona->id_persona;
            $chofer->pin = $request->input('p_pin');
            $chofer->save();
            DB::commit();

            $user = User::create([
                'name' => $persona->nombres,
                'email' => $persona->ci . "@transporte.com",
                'password' => Hash::make("123"),
                'id_persona' => $persona->id_persona,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Persona y Chofer insertados con éxito. ID de persona: ' . $persona->id_persona . ', ID de Chofer: ' . $chofer->id_chofer,
                'user' => $user,
            ]);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
    public function eliminarPersonaChofer($id_persona)
    {
        try {
            DB::beginTransaction();

            $choferes = Chofer::where('id_persona', $id_persona)->first();
            $choferes->delete();

            $persona = Persona::where('id_persona', $id_persona)->first();
            $persona->delete();

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

    public function editarPersonaChofer($id_persona)
    {
        try {
            DB::beginTransaction();
            // Buscar al estudiante
            $chofer = Chofer::join('personas', 'personas.id_persona', '=', 'chofers.id_persona')
                ->select(
                    'personas.nombres',
                    'personas.primer_apellido',
                    'personas.segundo_apellido',
                    'personas.ci',
                    'personas.fecha_nacimiento',
                    'personas.genero',
                    'personas.direccion',
                    'personas.celular as cel',
                    'chofers.celular',
                    'chofers.pin'
                )
                ->where('personas.id_persona', $id_persona)
                ->first();
            DB::commit();

            if (!$chofer) {
                return response()->json([
                    'success' => false,
                    'message' => 'Estudiante no encontrado.',
                ]);
            }

            return response()->json([
                'success' => true,
                'chofer' => $chofer,
            ]);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
    public function actualizarPersonaChofer(Request $request, $id_persona)
    {
        try {
            DB::beginTransaction();

            // Buscar al chofer a actualizar
            $chofer = Chofer::where('id_persona', $id_persona)->first();
            if (!$chofer) {
                throw new \Exception('Chofer no encontrado.');
            }

            // Actualizar datos de la persona
            $persona = Persona::where('id_persona', $id_persona)->first();
            if (!$persona) {
                throw new \Exception('Persona no encontrada.');
            }
            // Insertar en la tabla personas
            $persona->nombres = $request->input('nombres');
            $persona->primer_apellido = $request->input('primer_apellido');
            $persona->segundo_apellido = $request->input('segundo_apellido');
            $persona->ci = $request->input('ci');
            $persona->fecha_nacimiento = $request->input('fecha_nacimiento');
            $persona->genero = $request->input('genero');
            $persona->direccion = $request->input('direccion');
            $persona->celular = $request->input('celular');
            $persona->save();

            // Actualizar datos del choferes
            $chofer->celular = $request->input('celular');
            $chofer->pin = $request->input('pin');
            $chofer->save();

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

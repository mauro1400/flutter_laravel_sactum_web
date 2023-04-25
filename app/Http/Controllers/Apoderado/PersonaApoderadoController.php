<?php

namespace App\Http\Controllers\Apoderado;

use App\Http\Controllers\Controller;
use App\Models\Apoderado;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonaApoderadoController extends Controller
{
    public function index()
    {
        $listaApoderados = Apoderado::join('personas', 'personas.id_persona', '=', 'apoderados.id_persona')
            ->select(
                'apoderados.id_estudiante',
                'personas.id_persona',
                'personas.nombres',
                'personas.primer_apellido',
                'personas.segundo_apellido',
                'personas.ci',
                'personas.fecha_nacimiento',
                'personas.genero',
                'personas.direccion',
                'personas.celular as cel',
                'apoderados.celular',
                'apoderados.pin'
            )
            ->get();
        return response()->json([
            'listaApoderados' => $listaApoderados
        ]);
    }
    public function eliminarPersonaApoderado($id_persona)
    {
        try {
            DB::beginTransaction();

            $apoderado = Apoderado::where('id_persona', $id_persona)->first();
            $apoderado->delete();

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

    public function insertarPersonaApoderado(Request $request)
    {
        try {
            DB::beginTransaction();

            // Insertar en la tabla personas
            $persona = new Persona();
            $persona->nombres = $request->input('nombres');
            $persona->primer_apellido = $request->input('primer_apellido');
            $persona->segundo_apellido = $request->input('segundo_apellido');
            $persona->ci = $request->input('ci');
            $persona->fecha_nacimiento = $request->input('fecha_nacimiento');
            $persona->genero = $request->input('genero');
            $persona->direccion = $request->input('direccion');
            $persona->celular = $request->input('celular');
            $persona->save();

            // Insertar en la tabla choferes
            $apoderado = new Apoderado();
            $apoderado->id_persona = $persona->id_persona;
            $apoderado->pin = $request->input('pin');
            $apoderado->id_estudiante = $request->input('id_estudiante');
            $apoderado->save();
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Persona y Chofer insertados con éxito. ID de persona: ' . $persona->id_persona . ', ID de Chofer: ' . $apoderado->id_chofer,
            ]);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function editarPersonaApoderado($id_persona)
    {
        try {
            DB::beginTransaction();
            // Buscar al estudiante
            $apoderado = Apoderado::join('personas', 'personas.id_persona', '=', 'apoderados.id_persona')
                ->select(
                    'apoderados.id_estudiante',
                    'personas.id_persona',
                    'personas.nombres',
                    'personas.primer_apellido',
                    'personas.segundo_apellido',
                    'personas.ci',
                    'personas.fecha_nacimiento',
                    'personas.genero',
                    'personas.direccion',
                    'personas.celular as cel',
                    'apoderados.celular',
                    'apoderados.pin'
                )
                ->where('personas.id_persona', $id_persona)
                ->first();
            DB::commit();

            if (!$apoderado) {
                return response()->json([
                    'success' => false,
                    'message' => 'Apoderado no encontrado.',
                ]);
            }

            return response()->json([
                'success' => true,
                'apoderado' => $apoderado,
            ]);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function actualizarPersonaApoderado(Request $request, $id_persona)
    {
        try {
            DB::beginTransaction();

            // Buscar al chofer a actualizar
            $apoderado = Apoderado::where('id_persona', $id_persona)->first();
            if (!$apoderado) {
                throw new \Exception('Apoderado no encontrado.');
            }

            // Actualizar datos de la persona
            $persona = Persona::where('id_persona', $id_persona)->first();
            if (!$persona) {
                throw new \Exception('Persona no encontrada.');
            }
            
            $persona->nombres = $request->input('nombres');
            $persona->primer_apellido = $request->input('primer_apellido');
            $persona->segundo_apellido = $request->input('segundo_apellido');
            $persona->ci = $request->input('ci');
            $persona->fecha_nacimiento = $request->input('fecha_nacimiento');
            $persona->genero = $request->input('genero');
            $persona->direccion = $request->input('direccion');
            $persona->celular = $request->input('celular');
            $persona->save();
            
            $apoderado->id_persona = $persona->id_persona;
            $apoderado->pin = $request->input('pin');
            $apoderado->id_estudiante = $request->input('id_estudiante');
            $apoderado->save();

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

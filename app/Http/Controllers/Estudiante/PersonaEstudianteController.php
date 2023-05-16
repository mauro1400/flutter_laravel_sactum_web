<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Persona;
use App\Models\Estudiante;

class PersonaEstudianteController extends Controller
{
    public function index()
    {
        $estudiantes = Estudiante::join('personas', 'personas.id_persona', '=', 'estudiantes.id_persona')
            ->select(
                'personas.id_persona',
                'personas.nombres',
                'personas.primer_apellido',
                'personas.segundo_apellido',
                'personas.ci',
                'personas.fecha_nacimiento',
                'personas.genero',
                'personas.direccion',
                'personas.celular',
                'estudiantes.grado'
            )
            ->get();

        return response()->json([
            'estudiantes' => $estudiantes
        ]);
    }

    public function insertarPersonaEstudiante(Request $request)
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

            $estudiante = new Estudiante();
            $estudiante->id_persona = $persona->id_persona;
            $estudiante->grado = $request->input('p_grado');
            $estudiante->save();
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Persona y estudiante insertados con éxito. ID de persona: ' . $persona->id_persona . ', ID de estudiante: ' . $estudiante->id_estudiante,
            ]);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function eliminarPersonaEstudiante($id_persona)
    {
        try {
            DB::beginTransaction();

            $estudiante = Estudiante::where('id_persona', $id_persona)->first();
            $estudiante->delete();

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

    public function editarPersonaEstudiante($id_persona)
    {
        try {
            DB::beginTransaction();
            // Buscar al estudiante
            $estudiante = Estudiante::join('personas', 'personas.id_persona', '=', 'estudiantes.id_persona')
                ->select(
                    'personas.id_persona',
                    'personas.nombres',
                    'personas.primer_apellido',
                    'personas.segundo_apellido',
                    'personas.ci',
                    'personas.fecha_nacimiento',
                    'personas.genero',
                    'personas.direccion',
                    'personas.celular',
                    'estudiantes.grado'
                )
                ->where('personas.id_persona', $id_persona)
                ->first();

            DB::commit();

            if (!$estudiante) {
                return response()->json([
                    'success' => false,
                    'message' => 'Estudiante no encontrado.',
                ]);
            }

            return response()->json([
                'success' => true,
                'estudiante' => $estudiante,
            ]);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
    public function actualizarPersonaEstudiante(Request $request, $id_persona)
    {
        try {
            DB::beginTransaction();

            // Buscar al estudiante a actualizar
            $estudiante = Estudiante::where('id_persona', $id_persona)->first();
            if (!$estudiante) {
                throw new \Exception('Estudiante no encontrado.');
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

            // Actualizar datos del estudiante
            $estudiante->grado = $request->input('grado');
            $estudiante->save();

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

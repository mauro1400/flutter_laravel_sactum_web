<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Persona;
use App\Models\Estudiante;
use App\Models\Transporte;

class TransporteEstudianteController extends Controller
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
                'estudiantes.grado',
                'estudiantes.id_estudiante'
            )
            ->get();

        return response()->json([
            'estudiantes' => $estudiantes
        ]);
    }

    public function insertarTransporteEstudiante(Request $request)
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

    public function eliminarTransporteEstudiante($id_persona)
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

    public function editarTransporteEstudiante($id_persona)
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
    public function actualizarTransporteEstudiante(Request $request, $id_persona)
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
    // ------------------------------------------------------

    function DatosEstudianteTransporte(Request $request)
    {
        try {
            DB::beginTransaction();
            //$id_transporte = $request->id_transporte; // Este es el ID del transporte que quieres filtrar
            $id_transporte = 7;

            $datosTransportes = Persona::select(
                'personas.nombres',
                'personas.primer_apellido',
                'personas.segundo_apellido',
                'estudiantes.grado',
                'estudiante_transportes.id_estudiante_transporte',
                'transportes.id_transporte',
                'transportes.placa',
                'transportes.descripcion'
            )
                ->join('estudiantes', 'personas.id_persona', '=', 'estudiantes.id_persona')
                ->join('estudiante_transportes', 'estudiantes.id_estudiante', '=', 'estudiante_transportes.id_estudiante')
                ->join('transportes', 'transportes.id_transporte', '=', 'estudiante_transportes.id_transporte')
                ->where('transportes.id_transporte', '=', $id_transporte)
                ->get();

            $totalRegistros = $datosTransportes->count();

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Estudiantes Asignados',
                'totalRegistros' => $totalRegistros,
                'datosTransportes' => $datosTransportes,
            ], 200);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    function DatosChoferUsuario(Request $request)
    {
        try {

            DB::beginTransaction();
            $idPersona = $request->input('id_persona');

            $chofer = Chofer::select('chofers.id_chofer', 'personas.nombres', 'personas.primer_apellido', 'personas.segundo_apellido', 'transportes.id_transporte', 'transportes.modelo', 'transportes.placa')
                ->join('personas', 'chofers.id_persona', '=', 'personas.id_persona')
                ->join('transportes', 'chofers.id_chofer', '=', 'transportes.id_chofer')
                ->where('personas.id_persona', $idPersona)
                ->get();
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Datos Chofer',
                'chofer' => $chofer,
            ], 200);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
    public function LLamarLista(Request $request)
    {
        try {
            DB::beginTransaction();
            $asistensiaEstudiante = new EstudianteAsistencia();
            $asistensiaEstudiante->id_estudiante_transporte = $request->input('id_estudiante_transporte');
            $asistensiaEstudiante->id_estado = $request->input('id_estado');
            if ($asistensiaEstudiante->id_estado == 4) {
                $asistensiaEstudiante->mensaje_padre = 'El Estudiante ha subido al transporte escolar.Ten un excelente día.';
            } elseif ($asistensiaEstudiante->id_estado == 5) {
                $asistensiaEstudiante->mensaje_padre = 'El Estudiante ha bajado del transporte escolar.Ten un excelente día.';
            } else {
                $asistensiaEstudiante->mensaje_padre = '';
            }
            $asistensiaEstudiante->estado = 1;
            $asistensiaEstudiante->created_at = now();
            $asistensiaEstudiante->updated_at = now();
            $asistensiaEstudiante->save();
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Datos Chofer',
                'asistenciaEstudiante' => $asistensiaEstudiante,
            ], 200);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
    public function enviar_mensaje(Request $request)
    {
        try {
            DB::beginTransaction();
            $id_persona = $request->input('id_persona_apoderado');
            $estadoMensaje = EstudianteAsistencia::select('estudiante_asistencias.id_estado', 'estudiante_asistencias.mensaje_padre')
                ->join('estudiante_transportes', 'estudiante_asistencias.id_estudiante_transporte', '=', 'estudiante_transportes.id_estudiante_transporte')
                ->join('apoderados', 'estudiante_transportes.id_estudiante', '=', 'apoderados.id_estudiante')
                ->where('apoderados.id_persona', '=', $id_persona) // Replace 1 with the ID of the guardian's person
                ->orderByDesc('estudiante_asistencias.created_at')
                ->limit(1)
                ->get();
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Datos',
                'estadoMensaje' => $estadoMensaje,
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

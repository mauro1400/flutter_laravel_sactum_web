<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use App\Models\Chofer;
use App\Models\EstudianteAsistencia;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListaEstudiantesTransporte extends Controller
{
    function DatosEstudianteTransporte(Request $request)
    {
        try {
            DB::beginTransaction();
            $id_transporte = $request->input('id_transporte'); // Este es el ID del transporte que quieres filtrar
            //$id_transporte = 7;

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

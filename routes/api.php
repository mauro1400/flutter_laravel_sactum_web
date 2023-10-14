<?php

use App\Http\Controllers\Apoderado\PersonaApoderadoController;
use App\Http\Controllers\Estudiante\PersonaEstudianteController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Chofer\PersonaChoferController;
use App\Http\Controllers\Estudiante\ListaEstudiantesTransporte;
use App\Http\Controllers\Estudiante\TransporteEstudianteController;
use App\Http\Controllers\RegistroGps\RegistroGpsController;
use App\Http\Controllers\Transporte\TransporteController;
use App\Http\Controllers\Usuario\UsuarioController;
use App\Http\Controllers\Admin\GradoController;
use App\Http\Controllers\Admin\GestionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthenticationController::class, 'login']);
Route::post('/register', [AuthenticationController::class, 'register']);

Route::post('/id_persona_chofer', [PersonaChoferController::class, 'id_persona_chofer']);

Route::post('/ubicacion', [RegistroGpsController::class, 'registroGPS']);
Route::post('/enviarUbicacion', [RegistroGpsController::class, 'enviarUbicacion']);
Route::post('/estudiantes-transporte', [ListaEstudiantesTransporte::class, 'DatosEstudianteTransporte']);
Route::post('/informacionChofer', [ListaEstudiantesTransporte::class, 'DatosChoferUsuario']);
Route::post('/llamar-lista', [ListaEstudiantesTransporte::class, 'LLamarLista']);
Route::post('/enviar_mensaje', [ListaEstudiantesTransporte::class, 'enviar_mensaje']);

Route::get('/listarUsuarios', [UsuarioController::class, 'listarUsuarios']);


Route::middleware('auth:sanctum')->group(function () {

    Route::get('/listar-grado', [GradoController::class, 'index']);
    Route::get('/editar-grado/{id_grado}', [GradoController::class, 'edit']);
    Route::post('/insertar-grado', [GradoController::class, 'create']);
    Route::post('/actualizar-grado', [GradoController::class, 'update']);
    Route::get('/eliminar-grado/{id_grado}', [GradoController::class, 'eliminargrado']);

    Route::get('/listar-gestion', [GestionController::class, 'index']);
    Route::get('/editar-gestion/{id_gestion}', [GestionController::class, 'edit']);
    Route::post('/insertar-gestion', [GestionController::class, 'create']);
    Route::post('/actualizar-gestion', [GestionController::class, 'update']);
    Route::get('/eliminar-gestion/{id_gestion}', [GestionController::class, 'eliminargestion']);

    Route::get('/persona', [AuthenticationController::class, 'persona']);
    //usuarios
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    //estudiantes
    Route::get('/listar-estudiantes', [PersonaEstudianteController::class, 'index']);
    Route::post('/insertar-persona-estudiante', [PersonaEstudianteController::class, 'insertarPersonaEstudiante']);
    Route::delete('/eliminar-estudiantes/{id_persona}', [PersonaEstudianteController::class, 'eliminarPersonaEstudiante']);
    Route::get('/editar-estudiante/{id_persona}', [PersonaEstudianteController::class, 'editarPersonaEstudiante']);
    Route::post('/actualizar-estudiantes/{id_persona}', [PersonaEstudianteController::class, 'actualizarPersonaEstudiante']);

    //transporte-estudiante
    Route::get('/listar-transporte-estudiante/{id_transporte}', [TransporteEstudianteController::class, 'DatosEstudianteTransporte']);
    Route::post('/insertar-transporte-estudiante', [TransporteEstudianteController::class, 'insertarTransporteEstudiante']);
    Route::delete('/eliminar-transporte-estudiante/{id_persona}', [TransporteEstudianteController::class, 'eliminarTransporteEstudiante']);
    Route::get('/editar-transporte-estudiante/{id_persona}', [TransporteEstudianteController::class, 'editarTransporteEstudiante']);
    Route::post('/actualizar-transporte-estudiante/{id_persona}', [TransporteEstudianteController::class, 'actualizarTransporteEstudiante']);

    //chofer
    Route::get('/listar-chofer', [PersonaChoferController::class, 'index']);
    Route::post('/insertar-persona-chofer', [PersonaChoferController::class, 'insertarPersonaChofer']);
    Route::delete('/eliminar-chofer/{id_persona}', [PersonaChoferController::class, 'eliminarPersonaChofer']);
    Route::get('/editar-chofer/{id_persona}', [PersonaChoferController::class, 'editarPersonaChofer']);
    Route::post('/actualizar-chofer/{id_persona}', [PersonaChoferController::class, 'actualizarPersonaChofer']);

    //Apoderado
    Route::get('/listar-apoderado', [PersonaApoderadoController::class, 'index']);
    Route::post('/insertar-persona-apoderado', [PersonaApoderadoController::class, 'insertarPersonaApoderado']);
    Route::delete('/eliminar-apoderado/{id_persona}', [PersonaApoderadoController::class, 'eliminarPersonaApoderado']);
    Route::get('/editar-apoderado/{id_persona}', [PersonaApoderadoController::class, 'editarPersonaApoderado']);
    Route::post('/actualizar-apoderado/{id_persona}', [PersonaApoderadoController::class, 'actualizarPersonaApoderado']);

    //transporte
    Route::get('/listar-transporte', [TransporteController::class, 'index']);
    Route::post('/insertar-transporte', [TransporteController::class, 'insertarTransporte']);
    Route::delete('/eliminar-transporte/{id_transporte}', [TransporteController::class, 'eliminarTransporte']);
    Route::get('/editar-transporte/{id_transporte}', [TransporteController::class, 'editarTransporte']);
    Route::post('/actualizar-transporte/{id_transporte}', [TransporteController::class, 'actualizarTransporte']);

    Route::post('/logout', [AuthenticationController::class, 'logout']);
});

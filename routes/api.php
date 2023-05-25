<?php

use App\Http\Controllers\Apoderado\PersonaApoderadoController;
use App\Http\Controllers\Estudiante\PersonaEstudianteController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Chofer\PersonaChoferController;
use App\Http\Controllers\Estudiante\ListaEstudiantesTransporte;
use App\Http\Controllers\RegistroGps\RegistroGpsController;
use App\Http\Controllers\Transporte\TransporteController;
use App\Http\Controllers\Usuario\UsuarioController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    //Route::get('/informacion-usuario/{id}', [UsuarioController::class, 'informacionUsuario']);
    //estudiantes
    Route::get('/listar-estudiantes', [PersonaEstudianteController::class, 'index']);
    Route::post('/insertar-persona-estudiante', [PersonaEstudianteController::class, 'insertarPersonaEstudiante']);
    Route::delete('/eliminar-estudiantes/{id_persona}', [PersonaEstudianteController::class, 'eliminarPersonaEstudiante']);
    Route::get('/editar-estudiante/{id_persona}', [PersonaEstudianteController::class, 'editarPersonaEstudiante']);
    Route::post('/actualizar-estudiantes/{id_persona}', [PersonaEstudianteController::class, 'actualizarPersonaEstudiante']);
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

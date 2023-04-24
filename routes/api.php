<?php

use App\Http\Controllers\Estudiante\PersonaEstudianteController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Chofer\PersonaChoferController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthenticationController::class, 'login']);
Route::post('/register', [AuthenticationController::class, 'register']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
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

    Route::post('/logout', [AuthenticationController::class, 'logout']);
});

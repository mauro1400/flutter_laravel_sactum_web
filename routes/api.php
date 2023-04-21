<?php

use App\Http\Controllers\Estudiante\PersonaEstudianteController;
use App\Http\Controllers\AuthenticationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthenticationController::class, 'login']);
Route::post('/register', [AuthenticationController::class, 'register']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/listar-estudiantes', [PersonaEstudianteController::class, 'index']);
    Route::post('/insertar-persona-estudiante', [PersonaEstudianteController::class, 'insertarPersonaEstudiante']);
    Route::delete('/eliminar-estudiantes/{id_estudiante}', [PersonaEstudianteController::class, 'eliminarPersonaEstudiante']);
    Route::get('/editar-estudiante/{id_persona}', [PersonaEstudianteController::class, 'editarPersonaEstudiante']);
    Route::post('/actualizar-estudiantes/{id_persona}', [PersonaEstudianteController::class, 'actualizarPersonaEstudiante']);
    Route::post('/logout', [AuthenticationController::class, 'logout']);
});

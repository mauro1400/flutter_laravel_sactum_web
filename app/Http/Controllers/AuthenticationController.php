<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Persona;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Http\Requests\LoginRequest;

class AuthenticationController extends Controller
{
    use AuthenticatesUsers;

    public function register(Request $request)
    {
        /*$request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);*/

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
        $user = User::create($userData);
        $token = $user->createToken('token')->plainTextToken;
        return response([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        /*$request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);*/
        if (auth()->attempt(array('email' => $request->email, 'password' => $request->password))) {
            $user = User::whereEmail($request->email)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response(['message' => 'Credenciales Invalidas'], 402);
            }
            $token = $user->createToken('token')->plainTextToken;
            return response([
                'user' => $user,
                'token' => $token,
            ], 200);
        } else {
            throw new AuthenticationException();
        }
    }

    public function logout()
    {
        //$request->user()->currentAccessToken()->delete();
        Auth::guard('web')->logout(); 
        return response()->json(['message' => 'Cesion cerrada'], 200);
    }

    public function persona(Request $request)
    {
        //print_r($request);
        //dump($request->user()->id_persona);
        try {
            $id_persona = 37;//$request->user()->id_persona;
            $respuesta = Persona::select('id_persona', 'nombres', 'primer_apellido', 'segundo_apellido', 'ci', 'fecha_nacimiento', 'direccion', 'celular')
                ->where('id_persona', $id_persona)->first();
            if (empty($respuesta)) {
                return response()->json([
                    'message' => 'No se encontro a la Persona',
                    'errors' => ['TRANSPORTE' => ['No se encontro a la Persona']]
                ], 466);
            }
            return response()->json([
                'message' => 'Solicitud correcta',
                'data' => $respuesta
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error al consultar datos de persona id_persona='.$request,
                'errors' => [
                    'throwable' => [$th->getMessage()]
                ]
            ], 400);
        }
    }
    
}

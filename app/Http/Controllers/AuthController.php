<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller{

    // Al hacer login el user, se pasa como parámetro el email y la password 
    // Si coinciden ambos, se devuelve un token JWS
    //
    // Ej respuesta :  "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE3MTQ5MTA2OTcsImV4cCI6MTcxNDkxNDI5NywibmJmIjoxNzE0OTEwNjk3LCJqdGkiOiJoMm5DeTRKZkxaUkRJeWZPIiwic3ViIjoiNDEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.wvXI0EPfJhMWlV6G-oIDYtci5JbdOwgzcUz3F-XzmuI",
    //                 "token_type": "bearer",
    //                 "expires_in": 3600
    //
    public function login() {
        $credentials = request (['email', 'password']);

        if (! $token = auth ()->attempt ($credentials)) {
            return response ()->json (['error' => 'No autorizado'], 401);
        }
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'rol' => Auth::user()->rol 
        ]);
    }
}   
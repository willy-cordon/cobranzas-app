<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'user',
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(['token' => $token]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

    // Verificar las credenciales y generar el token
    if (!$token = JWTAuth::attempt($credentials)) {
        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    // Obtener el usuario
    $user = User::where('email', $request->email)->first();

    // Incluir el rol en el token (como parte de los claims personalizados)
    $customClaims = [
        'role' => $user->role, // Suponiendo que el campo 'role' existe en tu tabla de usuarios
    ];

    // Generar el token con los claims personalizados
    $tokenWithClaims = JWTAuth::claims($customClaims)->attempt($credentials);

    // Retornar el token junto con el rol
    return response()->json(['token' => $tokenWithClaims, 'role' => $user->role]);
    }

    public function logout(Request $request)
    {
        auth()->logout(); // Si usas guard
        return response()->json(['message' => 'Logged out successfully'], 200);
    }


    public function profile()
    {
        return response()->json(auth()->user());
    }
}


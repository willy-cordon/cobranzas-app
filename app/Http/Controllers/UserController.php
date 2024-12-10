<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Obtener todos los usuarios con los campos name, email y role
        $users = User::select('name', 'email', 'role')->get();
        return response()->json($users);
    }
}

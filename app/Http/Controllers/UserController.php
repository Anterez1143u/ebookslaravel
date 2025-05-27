<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::simplePaginate(5);
        $roles = Role::all(); // Obtener todos los roles disponibles
        return view('admin.usuarios.index', compact('usuarios', 'roles'));
    }

    public function asignarRol(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->role_id = $request->role_id; // Asignar nuevo rol
        $user->save();

        return redirect()->route('admin.usuarios')->with('success', 'Rol asignado correctamente.');
    }
}
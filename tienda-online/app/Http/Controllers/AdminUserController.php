<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    /**
     * Lista todos los usuarios (ADMIN).
     */
    public function index()
    {
        // Traer todos los usuarios o paginarlos
        $users = User::orderBy('id','desc')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Muestra el formulario para crear un usuario.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Almacena un nuevo usuario en base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'role'  => 'required|in:admin,customer',
            'password' => 'required|string|min:6|confirmed', 
            // Usamos 'confirmed' si en el formulario tenemos password_confirmation
        ]);

        $user = new User();
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->role  = $request->role;
        // Encriptamos la contraseña
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.users.index')
                         ->with('success','Usuario creado correctamente');
    }

    /**
     * Mostrar la información de un usuario específico (opcional).
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Mostrar formulario para editar un usuario existente.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Actualiza los datos de un usuario.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role'  => 'required|in:admin,customer',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->role  = $request->role;

        // Si el admin desea cambiar la contraseña:
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')
                         ->with('success','Usuario actualizado correctamente');
    }

    /**
     * Elimina un usuario.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                             ->with('error','No puedes eliminar tu propio usuario.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
                         ->with('success','Usuario eliminado correctamente');
    }
}

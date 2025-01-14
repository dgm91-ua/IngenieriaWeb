<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'No tienes permisos para acceder a esta página.');
        }
    
        // Aquí tu lógica de administrador...
        return view('admin.dashboard');
    }
}

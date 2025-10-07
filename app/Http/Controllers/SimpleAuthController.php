<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SimpleAuthController extends Controller
{
    // Usuarios de prueba (hardcodeados) - Roles según doc1.txt
    private $users = [
        [
            'email' => 'secretario@simpac.com',
            'password' => 'secretario123',
            'name' => 'Secretario CTPPGE',
            'role' => 'Secretario CTPPGE',
            'description' => 'Coordinador general del proceso'
        ],
        [
            'email' => 'procurador@simpac.com',
            'password' => 'procurador123',
            'name' => 'Procurador(a) PGE',
            'role' => 'Procuraduría',
            'description' => 'Validación legal y suscripción de actas'
        ],
        [
            'email' => 'responsable@simpac.com',
            'password' => 'responsable123',
            'name' => 'Responsable de Componente',
            'role' => 'Responsable de Componente',
            'description' => 'Ejecutor de componentes específicos'
        ],
        [
            'email' => 'colegiado@simpac.com',
            'password' => 'colegiado123',
            'name' => 'Miembro Órgano Colegiado',
            'role' => 'Órgano Colegiado',
            'description' => 'Aprobación de planes y validación'
        ]
    ];

    public function showLogin()
    {
        // Si ya está autenticado, redirigir al dashboard
        if (Session::has('user')) {
            return redirect()->route('dashboard');
        }
        
        return view('auth.simple-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Buscar usuario
        foreach ($this->users as $user) {
            if ($user['email'] === $request->email && $user['password'] === $request->password) {
                // Guardar en sesión
                Session::put('user', [
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'role' => $user['role']
                ]);
                
                // Guardar también como variables individuales para facilitar el acceso
                Session::put('user_name', $user['name']);
                Session::put('user_email', $user['email']);
                Session::put('user_role', $user['role']);
                
                return redirect()->route('dashboard')->with('success', '¡Bienvenido ' . $user['name'] . '!');
            }
        }

        return back()->withErrors(['email' => 'Credenciales incorrectas'])->withInput();
    }

    public function logout()
    {
        Session::forget('user');
        return redirect()->route('login')->with('success', 'Sesión cerrada correctamente');
    }
}

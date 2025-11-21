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
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            // Intentar autenticación con la base de datos
            $user = \App\Models\User::where('email', $request->email)->first();

            if ($user && \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
                // Guardar datos del usuario en la sesión existente
                $request->session()->put('user', [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                    'sectorista_id' => $user->sectorista_id,
                ]);
                
                // Guardar también como variables individuales para facilitar el acceso
                $request->session()->put('user_id', $user->id);
                $request->session()->put('user_name', $user->name);
                $request->session()->put('user_email', $user->email);
                $request->session()->put('user_role', $user->role);
                $request->session()->put('user_sectorista_id', $user->sectorista_id);
                
                // CRÍTICO: Guardar la sesión explícitamente antes de redirigir
                $request->session()->save();
                
                // DEBUG: Log login exitoso
                \Illuminate\Support\Facades\Log::info('✅ Login exitoso - Datos guardados en sesión', [
                    'user_id' => $user->id,
                    'email' => $user->email,
                    'role' => $user->role,
                    'session_id' => $request->session()->getId(),
                    'session_has_user' => $request->session()->has('user'),
                    'session_saved' => true,
                ]);
            
                // Redirigir según el rol
                return $this->redirectByRole($user);
            }

            // Fallback: buscar en usuarios hardcodeados
            foreach ($this->users as $hardcodedUser) {
                if ($hardcodedUser['email'] === $request->email && $hardcodedUser['password'] === $request->password) {
                    Session::put('user', [
                        'name' => $hardcodedUser['name'],
                        'email' => $hardcodedUser['email'],
                        'role' => $hardcodedUser['role']
                    ]);
                    
                    Session::put('user_name', $hardcodedUser['name']);
                    Session::put('user_email', $hardcodedUser['email']);
                    Session::put('user_role', $hardcodedUser['role']);
                    
                    return redirect()->route('dashboard')->with('success', '¡Bienvenido ' . $hardcodedUser['name'] . '!');
                }
            }

            return back()->withErrors(['email' => 'Credenciales incorrectas'])->withInput();
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('❌ Error en login: ' . $e->getMessage(), [
                'exception' => $e->getTraceAsString(),
                'email' => $request->email ?? 'N/A',
            ]);
            
            return back()->withErrors(['email' => 'Error del servidor: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Redirigir al usuario según su rol
     */
    private function redirectByRole($user)
    {
        $message = '¡Bienvenido ' . $user->name . '!';

        switch ($user->role) {
            case 'admin':
                // Admin tiene acceso total a todos los módulos
                return redirect()->route('dashboard')->with('success', $message);

            case 'secretario_ctppge':
                // Secretario ve todo el dashboard general y puede editar Actividad 1
                return redirect()->route('dashboard')->with('success', $message);

            case 'sectorista':
                // Sectorista va directo a sus entidades asignadas (Actividad 2)
                if ($user->sectorista_id) {
                    return redirect()->route('activity2.index', $user->sectorista_id)
                        ->with('success', $message);
                }
                return redirect()->route('dashboard')->with('success', $message);

            case 'procurador_pge':
                // Procurador puede ver todos los módulos
                return redirect()->route('dashboard')->with('success', $message);

            case 'responsable_componente':
                // Responsable de componente ve sus componentes
                return redirect()->route('dashboard')->with('success', $message);

            case 'organo_colegiado':
                // Órgano colegiado ve planes para aprobar
                return redirect()->route('dashboard')->with('success', $message);

            default:
                return redirect()->route('dashboard')->with('success', $message);
        }
    }

    public function logout()
    {
        Session::forget('user');
        return redirect()->route('login')->with('success', 'Sesión cerrada correctamente');
    }
}

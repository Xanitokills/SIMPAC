<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class SimpleAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // CRITICAL DEBUG: Log that middleware is running
        \Log::critical('🔒 SimpleAuth Middleware EXECUTED', [
            'url' => $request->url(),
            'path' => $request->path(),
            'method' => $request->method(),
        ]);
        
        // DEBUG: Log session info
        Log::info('SimpleAuth Middleware - Session Check', [
            'url' => $request->url(),
            'session_id' => $request->session()->getId(),
            'session_driver' => config('session.driver'),
            'has_user' => $request->session()->has('user'),
            'user_data' => $request->session()->get('user'),
            'all_session' => $request->session()->all(),
            'cookies' => $request->cookies->all(),
        ]);

        if (!$request->session()->has('user')) {
            Log::warning('SimpleAuth: Usuario no autenticado, redirigiendo a login');
            return redirect()->route('login')->with('error', 'Debes iniciar sesión primero');
        }

        // Obtener datos del usuario de la sesión
        $userData = $request->session()->get('user');
        
        // Cargar el modelo User de la base de datos para auth()
        $user = \App\Models\User::find($userData['id']);
        
        if ($user) {
            // Establecer el usuario en el guard de Laravel para que auth()->user() funcione
            auth()->login($user);
            
            Log::info('SimpleAuth: Usuario autenticado correctamente', [
                'user' => $userData,
                'auth_set' => true
            ]);
        } else {
            Log::warning('SimpleAuth: Usuario no encontrado en BD, limpiando sesión');
            $request->session()->forget('user');
            return redirect()->route('login')->with('error', 'Usuario no encontrado');
        }

        return $next($request);
    }
}

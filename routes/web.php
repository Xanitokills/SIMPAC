<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SimpleAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImplementationPlanController;
use App\Http\Controllers\EntityAssignmentController;
use App\Http\Controllers\SectoristaController;

// Redirigir la raíz al login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas de autenticación
Route::get('/login', [SimpleAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [SimpleAuthController::class, 'login'])->name('login.post');
Route::post('/logout', [SimpleAuthController::class, 'logout'])->name('logout');

// Rutas protegidas del dashboard
Route::middleware('simple.auth')->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/planning', [DashboardController::class, 'planning'])->name('dashboard.planning');
    Route::get('/execution', [DashboardController::class, 'execution'])->name('dashboard.execution');
    Route::get('/validation', [DashboardController::class, 'validation'])->name('dashboard.validation');
    Route::get('/components', [DashboardController::class, 'components'])->name('dashboard.components');
    Route::get('/documents', [DashboardController::class, 'documents'])->name('dashboard.documents');
    Route::get('/timeline', [DashboardController::class, 'timeline'])->name('dashboard.timeline');
    
    // Rutas de Planes de Implementación
    Route::resource('implementation-plans', ImplementationPlanController::class);
    Route::post('implementation-plans/{implementationPlan}/close', [ImplementationPlanController::class, 'close'])
        ->name('implementation-plans.close');
    
    // Rutas de Asignaciones de Entidades (contextuales al plan)
    Route::resource('entity-assignments', EntityAssignmentController::class);
    Route::patch('plans/{plan}/assignments/{assignment}/complete', [EntityAssignmentController::class, 'complete'])
        ->name('entity-assignments.complete');
    Route::patch('plans/{plan}/assignments/{assignment}/cancel', [EntityAssignmentController::class, 'cancel'])
        ->name('entity-assignments.cancel');
    
    // Rutas de Sectoristas
    Route::resource('sectoristas', SectoristaController::class);
});

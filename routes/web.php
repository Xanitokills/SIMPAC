<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SimpleAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImplementationPlanController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\SectoristaController;
use App\Http\Controllers\EntityAssignmentController;

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
    
    // Rutas de Entidades
    Route::resource('entities', EntityController::class);
    
    // Rutas de Sectoristas
    Route::resource('sectoristas', SectoristaController::class);
    
    // Rutas de Asignaciones de Entidades
    Route::resource('entity-assignments', EntityAssignmentController::class);
    Route::post('entity-assignments/{entityAssignment}/complete', [EntityAssignmentController::class, 'complete'])
        ->name('entity-assignments.complete');
    Route::post('entity-assignments/{entityAssignment}/cancel', [EntityAssignmentController::class, 'cancel'])
        ->name('entity-assignments.cancel');
});

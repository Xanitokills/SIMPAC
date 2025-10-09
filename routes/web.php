<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SimpleAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImplementationPlanController;
use App\Http\Controllers\EntityAssignmentController;
use App\Http\Controllers\SectoristaController;
use App\Http\Controllers\Activity2Controller;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\OficioController;
use App\Http\Controllers\InductionSessionController;
use App\Http\Controllers\AgreementTrackingController;

// Redirigir la raíz al login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas de autenticación
Route::get('/login', [SimpleAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [SimpleAuthController::class, 'login'])->name('login.post');
Route::post('/logout', [SimpleAuthController::class, 'logout'])->name('logout');

// Ruta temporal de perfil (redirige al dashboard por ahora)
Route::middleware('simple.auth')->get('/profile', function () {
    return redirect()->route('dashboard')->with('info', 'Función de perfil próximamente');
})->name('profile.edit');

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
    
    // ===== ACTIVIDAD 2: Solicitar conformación del Órgano Colegiado =====
    
    // Panel principal de Actividad 2 - Ver entidades asignadas
    Route::get('activity2/sectorista/{sectorista?}', [Activity2Controller::class, 'index'])
        ->name('activity2.index');
    Route::get('activity2/assignment/{assignment}', [Activity2Controller::class, 'show'])
        ->name('activity2.show');
    Route::get('activity2/assignment/{assignment}/edit', [Activity2Controller::class, 'edit'])
        ->name('activity2.edit');
    Route::put('activity2/assignment/{assignment}', [Activity2Controller::class, 'update'])
        ->name('activity2.update');
    
    // Reuniones - Gestión completa
    Route::prefix('assignments/{assignment}/meetings')->name('meetings.')->group(function () {
        Route::get('/', [MeetingController::class, 'index'])->name('index');
        Route::get('create', [MeetingController::class, 'create'])->name('create');
        Route::post('/', [MeetingController::class, 'store'])->name('store');
    });
    
    Route::prefix('meetings')->name('meetings.')->group(function () {
        Route::get('{meeting}', [MeetingController::class, 'show'])->name('show');
        Route::get('{meeting}/edit', [MeetingController::class, 'edit'])->name('edit');
        Route::put('{meeting}', [MeetingController::class, 'update'])->name('update');
        Route::post('{meeting}/complete', [MeetingController::class, 'complete'])->name('complete');
        Route::get('{meeting}/history', [MeetingController::class, 'history'])->name('history');
        
        // Acuerdos de reunión
        Route::post('{meeting}/agreements', [MeetingController::class, 'addAgreement'])->name('agreements.add');
        Route::patch('{meeting}/agreements/{agreement}', [MeetingController::class, 'updateAgreementStatus'])
            ->name('agreements.update-status');
    });
    
    // Oficios - Solicitud y Reiteración
    Route::prefix('assignments/{assignment}/oficios')->name('oficios.')->group(function () {
        Route::get('/', [OficioController::class, 'index'])->name('index');
        Route::get('create', [OficioController::class, 'create'])->name('create');
        Route::post('/', [OficioController::class, 'store'])->name('store');
    });
    
    Route::prefix('oficios')->name('oficios.')->group(function () {
        Route::get('{oficio}', [OficioController::class, 'show'])->name('show');
        Route::get('{oficio}/create-reiteration', [OficioController::class, 'createReiteration'])
            ->name('create-reiteration');
        Route::get('{oficio}/generate-document', [OficioController::class, 'generateDocument'])
            ->name('generate-document');
        
        // Actos resolutivos
        Route::post('{oficio}/acto-resolutivo', [OficioController::class, 'uploadActoResolutivo'])
            ->name('acto-resolutivo.upload');
        Route::get('{oficio}/acto-resolutivo/download', [OficioController::class, 'downloadActoResolutivo'])
            ->name('acto-resolutivo.download');
    });
    
    // Sesiones de Inducción
    Route::prefix('assignments/{assignment}/induction-sessions')->name('induction-sessions.')->group(function () {
        Route::get('/', [InductionSessionController::class, 'index'])->name('index');
        Route::get('create', [InductionSessionController::class, 'create'])->name('create');
        Route::post('/', [InductionSessionController::class, 'store'])->name('store');
    });
    
    Route::prefix('induction-sessions')->name('induction-sessions.')->group(function () {
        Route::get('{session}', [InductionSessionController::class, 'show'])->name('show');
        Route::get('{session}/edit', [InductionSessionController::class, 'edit'])->name('edit');
        Route::put('{session}', [InductionSessionController::class, 'update'])->name('update');
        Route::post('{session}/complete', [InductionSessionController::class, 'complete'])->name('complete');
        Route::post('{session}/cancel', [InductionSessionController::class, 'cancel'])->name('cancel');
    });
    
    // Seguimiento de Acuerdos
    Route::prefix('agreements')->name('agreements.')->group(function () {
        Route::get('assignment/{assignment}/tracking', [AgreementTrackingController::class, 'index'])
            ->name('tracking');
        Route::get('assignment/{assignment}/kanban', [AgreementTrackingController::class, 'kanban'])
            ->name('kanban');
        Route::patch('{agreement}/status', [AgreementTrackingController::class, 'updateStatus'])
            ->name('update-status');
        Route::get('sectorista/{sectorista}/dashboard', [AgreementTrackingController::class, 'dashboard'])
            ->name('dashboard');
    });
});

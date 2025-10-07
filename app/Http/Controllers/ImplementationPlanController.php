<?php

namespace App\Http\Controllers;

use App\Models\ImplementationPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ImplementationPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activePlan = ImplementationPlan::getActivePlan();
        $plans = ImplementationPlan::orderBy('created_at', 'desc')->paginate(10);
        
        return view('dashboard.implementation-plans.index', compact('activePlan', 'plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Verificar si existe un plan activo
        if (ImplementationPlan::hasActivePlan()) {
            return redirect()
                ->route('implementation-plans.index')
                ->with('error', 'Ya existe un Plan de Implementación activo. No puede haber 2 planes en curso.');
        }

        return view('dashboard.implementation-plans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar que no exista un plan activo
        if (ImplementationPlan::hasActivePlan()) {
            return back()
                ->withInput()
                ->with('error', 'Ya existe un Plan de Implementación activo. No puede haber 2 planes en curso.');
        }

        $validated = $request->validate([
            'resolution_type' => 'required|in:RM,RD,DS',
            'resolution_number' => 'required|string|unique:implementation_plans,resolution_number',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'pdf_document' => 'required|file|mimes:pdf|max:10240', // Max 10MB
            'start_date' => 'required|date',
        ]);

        // Subir el PDF
        $pdfPath = $request->file('pdf_document')->store('implementation-plans', 'public');

        // Crear el plan
        $plan = ImplementationPlan::create([
            'resolution_type' => $validated['resolution_type'],
            'resolution_number' => $validated['resolution_number'],
            'name' => $validated['name'],
            'description' => $validated['description'],
            'pdf_path' => $pdfPath,
            'start_date' => $validated['start_date'],
            'status' => 'active',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return redirect()
            ->route('implementation-plans.show', $plan)
            ->with('success', 'Plan de Implementación registrado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ImplementationPlan $implementationPlan)
    {
        return view('dashboard.implementation-plans.show', compact('implementationPlan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ImplementationPlan $implementationPlan)
    {
        // Solo permitir editar si está activo
        if ($implementationPlan->status !== 'active') {
            return redirect()
                ->route('implementation-plans.show', $implementationPlan)
                ->with('error', 'Solo se pueden editar planes activos.');
        }

        return view('dashboard.implementation-plans.edit', compact('implementationPlan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ImplementationPlan $implementationPlan)
    {
        $validated = $request->validate([
            'resolution_type' => 'required|in:RM,RD,DS',
            'resolution_number' => 'required|string|unique:implementation_plans,resolution_number,' . $implementationPlan->id,
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'pdf_document' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        // Si hay un nuevo PDF, subir y eliminar el anterior
        if ($request->hasFile('pdf_document')) {
            // Eliminar PDF anterior
            Storage::disk('public')->delete($implementationPlan->pdf_path);
            
            // Subir nuevo PDF
            $pdfPath = $request->file('pdf_document')->store('implementation-plans', 'public');
            $validated['pdf_path'] = $pdfPath;
        }

        $implementationPlan->update($validated);

        return redirect()
            ->route('implementation-plans.show', $implementationPlan)
            ->with('success', 'Plan de Implementación actualizado exitosamente.');
    }

    /**
     * Cerrar el plan actual y preparar para uno nuevo (modificación/actualización)
     */
    public function close(ImplementationPlan $implementationPlan)
    {
        if ($implementationPlan->status !== 'active') {
            return back()->with('error', 'Solo se pueden cerrar planes activos.');
        }

        // Establecer fecha fin y cambiar estado
        $implementationPlan->update([
            'end_date' => now(),
            'status' => 'expired',
        ]);

        return redirect()
            ->route('implementation-plans.index')
            ->with('success', 'Plan de Implementación cerrado. Ahora puede registrar un nuevo plan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ImplementationPlan $implementationPlan)
    {
        // Solo permitir eliminar si no está activo
        if ($implementationPlan->status === 'active') {
            return back()->with('error', 'No se puede eliminar un plan activo.');
        }

        // Eliminar PDF
        Storage::disk('public')->delete($implementationPlan->pdf_path);
        
        $implementationPlan->delete();

        return redirect()
            ->route('implementation-plans.index')
            ->with('success', 'Plan de Implementación eliminado exitosamente.');
    }
}

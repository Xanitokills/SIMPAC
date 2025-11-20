<?php

namespace App\Http\Controllers;

use App\Models\MeetingMinute;
use App\Models\EntityAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MeetingMinuteController extends Controller
{
    public function create($assignmentId)
    {
        $assignment = EntityAssignment::with('entity')->findOrFail($assignmentId);
        return view('dashboard.execution.minutes.create', compact('assignment'));
    }

    public function store(Request $request, $assignmentId)
    {
        $assignment = EntityAssignment::findOrFail($assignmentId);

        $validated = $request->validate([
            'minute_number' => 'required|string|max:50',
            'date' => 'required|date',
            'subject' => 'required|string|max:255',
            'component' => 'nullable|string',
            'status' => 'required|in:firmado,falta_de_firma,proceso_de_firmas,proceso_de_firmas_pge',
            'pdf' => 'nullable|file|mimes:pdf|max:10240'
        ]);

        $data = [
            'entity_assignment_id' => $assignment->id,
            'minute_number' => $validated['minute_number'],
            'date' => $validated['date'],
            'subject' => $validated['subject'],
            'component' => $validated['component'] ?? null,
            'status' => $validated['status'],
            'created_by' => auth()->user()->id ?? null,
        ];

        if ($request->hasFile('pdf')) {
            $path = $request->file('pdf')->store('meeting_minutes');
            $data['pdf_path'] = $path;
        }

        $minute = MeetingMinute::create($data);

        return redirect()->route('execution.entity', $assignment->id)
            ->with('success', 'Acta guardada correctamente.');
    }

    public function download($id)
    {
        $minute = MeetingMinute::findOrFail($id);
        if (!$minute->pdf_path || !Storage::exists($minute->pdf_path)) {
            return redirect()->back()->with('error', 'Archivo PDF no disponible.');
        }
        return Storage::download($minute->pdf_path, "acta_{$minute->minute_number}.pdf");
    }
}

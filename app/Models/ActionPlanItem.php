<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActionPlanItem extends Model
{
    protected $fillable = [
        'action_plan_id',
        'action_name',
        'description',
        'responsible',
        'section_name',
        'predecessor_action',
        'due_date',
        'start_date',
        'end_date',
        'business_days',
        'status',
        'comments',
        'problems',
        'corrective_measures',
        'attachments',
        'order',
    ];

    protected $casts = [
        'due_date' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',
        'attachments' => 'array',
    ];

    /**
     * Calcular los días hábiles entre dos fechas
     */
    public function calculateBusinessDays()
    {
        if (!$this->start_date || !$this->end_date) {
            return null;
        }

        $start = $this->start_date;
        $end = $this->end_date;
        $days = 0;

        while ($start <= $end) {
            // Contar solo días de lunes a viernes
            if ($start->dayOfWeek !== 0 && $start->dayOfWeek !== 6) {
                $days++;
            }
            $start = $start->addDay();
        }

        $this->business_days = $days;
        return $days;
    }

    /**
     * Relación con el plan de acción
     */
    public function actionPlan(): BelongsTo
    {
        return $this->belongsTo(ActionPlan::class);
    }

    /**
     * Normalizar valores de status antes de guardarlos en la BD
     */
    public function setStatusAttribute($value)
    {
        if ($value === 'proceso') {
            $this->attributes['status'] = 'en_proceso';
            return;
        }
        if ($value === 'finalizado') {
            $this->attributes['status'] = 'completado';
            return;
        }

        // Otros valores se guardan tal cual
        $this->attributes['status'] = $value;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActionPlanItem extends Model
{
    protected $fillable = [
        'action_plan_id',
        'action_description',
        'responsible',
        'predecessor_action',
        'deadline',
        'start_date',
        'end_date',
        'business_days',
        'status',
        'comments',
        'problems',
        'corrective_measures',
        'file_path',
    ];

    protected $casts = [
        'deadline' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Relación con el plan de acción
     */
    public function actionPlan(): BelongsTo
    {
        return $this->belongsTo(ActionPlan::class);
    }
}

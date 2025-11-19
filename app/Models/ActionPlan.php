<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ActionPlan extends Model
{
    protected $fillable = [
        'entity_assignment_id',
        'title',
        'description',
        'approval_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'approval_date' => 'date',
    ];

    /**
     * Relación con la asignación de entidad
     */
    public function entityAssignment(): BelongsTo
    {
        return $this->belongsTo(EntityAssignment::class);
    }

    /**
     * Alias para entityAssignment
     */
    public function assignment(): BelongsTo
    {
        return $this->belongsTo(EntityAssignment::class, 'entity_assignment_id');
    }

    /**
     * Relación con los items del plan de acción
     */
    public function items(): HasMany
    {
        return $this->hasMany(ActionPlanItem::class);
    }
}

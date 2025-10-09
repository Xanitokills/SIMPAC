<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class EntityAssignment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'entity_id',
        'sectorista_id',
        'implementation_plan_id',
        'assigned_at',
        'completed_at',
        'status',
        'assigned_by',
        'notes',
        'priority',
    ];

    protected $casts = [
        'assigned_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    /**
     * Relación con la entidad
     */
    public function entity(): BelongsTo
    {
        return $this->belongsTo(Entity::class);
    }

    /**
     * Relación con el sectorista
     */
    public function sectorista(): BelongsTo
    {
        return $this->belongsTo(Sectorista::class);
    }

    /**
     * Relación con el plan de implementación
     */
    public function implementationPlan(): BelongsTo
    {
        return $this->belongsTo(ImplementationPlan::class);
    }

    /**
     * Relación con el usuario que asignó
     */
    public function assignedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    /**
     * Relación con las reuniones
     */
    public function meetings(): HasMany
    {
        return $this->hasMany(Meeting::class);
    }

    /**
     * Relación con los oficios
     */
    public function oficios(): HasMany
    {
        return $this->hasMany(Oficio::class);
    }

    /**
     * Relación con las sesiones de inducción
     */
    public function inductionSessions(): HasMany
    {
        return $this->hasMany(InductionSession::class);
    }

    /**
     * Scope para asignaciones activas
     */
    public function scopeActive($query)
    {
        return $query->whereIn('status', ['in_progress', 'pending']);
    }

    /**
     * Scope para asignaciones de un plan específico
     */
    public function scopeForPlan($query, $planId)
    {
        return $query->where('implementation_plan_id', $planId);
    }
}

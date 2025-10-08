<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class InductionSession extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'entity_assignment_id',
        'acto_resolutivo_id',
        'subject',
        'session_date',
        'meeting_link',
        'guidelines',
        'action_plan',
        'status',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'session_date' => 'datetime',
    ];

    /**
     * Relación con la asignación de entidad
     */
    public function entityAssignment(): BelongsTo
    {
        return $this->belongsTo(EntityAssignment::class);
    }

    /**
     * Relación con el acto resolutivo
     */
    public function actoResolutivo(): BelongsTo
    {
        return $this->belongsTo(ActoResolutivo::class);
    }

    /**
     * Relación con el usuario creador
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Scope para sesiones programadas
     */
    public function scopeScheduled($query)
    {
        return $query->where('status', 'scheduled');
    }

    /**
     * Scope para sesiones completadas
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Verificar si la sesión está próxima
     */
    public function isUpcoming(): bool
    {
        return $this->session_date->isFuture() && 
               $this->session_date->diffInDays(now()) <= 7;
    }
}

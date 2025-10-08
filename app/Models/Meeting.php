<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meeting extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'entity_assignment_id',
        'contact_name',
        'contact_email',
        'contact_phone',
        'subject',
        'scheduled_date',
        'meeting_link',
        'status',
        'conclusion',
        'notes',
    ];

    protected $casts = [
        'scheduled_date' => 'datetime',
    ];

    /**
     * Relación con la asignación de entidad
     */
    public function entityAssignment(): BelongsTo
    {
        return $this->belongsTo(EntityAssignment::class);
    }

    /**
     * Relación con el historial de cambios
     */
    public function history(): HasMany
    {
        return $this->hasMany(MeetingHistory::class);
    }

    /**
     * Relación con los acuerdos
     */
    public function agreements(): HasMany
    {
        return $this->hasMany(MeetingAgreement::class);
    }

    /**
     * Scope para reuniones programadas
     */
    public function scopeScheduled($query)
    {
        return $query->where('status', 'scheduled');
    }

    /**
     * Scope para reuniones completadas
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Obtener si la reunión está próxima (dentro de 3 días)
     */
    public function isUpcoming(): bool
    {
        return $this->scheduled_date->isFuture() && 
               $this->scheduled_date->diffInDays(now()) <= 3;
    }
}

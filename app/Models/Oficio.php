<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Oficio extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'entity_assignment_id',
        'type',
        'subject',
        'description',
        'deadline_date',
        'issue_date',
        'oficio_number',
        'status',
        'created_by',
    ];

    protected $casts = [
        'deadline_date' => 'date',
        'issue_date' => 'date',
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
    public function actoResolutivo(): HasOne
    {
        return $this->hasOne(ActoResolutivo::class);
    }

    /**
     * Relación con el usuario creador
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Scope para oficios pendientes
     */
    public function scopePendiente($query)
    {
        return $query->where('status', 'pendiente');
    }

    /**
     * Scope para oficios vencidos
     */
    public function scopeVencido($query)
    {
        return $query->where('status', 'vencido');
    }

    /**
     * Verificar si el oficio está vencido
     */
    public function isOverdue(): bool
    {
        if ($this->status === 'cumplido') {
            return false;
        }
        
        return $this->deadline_date && $this->deadline_date->isPast();
    }

    /**
     * Actualizar estado a vencido si corresponde
     */
    public function checkAndUpdateStatus(): void
    {
        if ($this->isOverdue() && $this->status === 'pendiente') {
            $this->update(['status' => 'vencido']);
        }
    }
}

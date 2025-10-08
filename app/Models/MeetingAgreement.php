<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class MeetingAgreement extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'meeting_id',
        'agreement',
        'deadline_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'deadline_date' => 'date',
    ];

    /**
     * Relación con la reunión
     */
    public function meeting(): BelongsTo
    {
        return $this->belongsTo(Meeting::class);
    }

    /**
     * Scope para acuerdos pendientes
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pendiente');
    }

    /**
     * Scope para acuerdos vencidos
     */
    public function scopeOverdue($query)
    {
        return $query->where('status', 'vencido')
                     ->orWhere(function($q) {
                         $q->where('status', 'pendiente')
                           ->where('deadline_date', '<', Carbon::now());
                     });
    }

    /**
     * Verificar si el acuerdo está vencido
     */
    public function isOverdue(): bool
    {
        if ($this->status === 'cumplido') {
            return false;
        }
        
        return $this->deadline_date && $this->deadline_date->isPast();
    }

    /**
     * Marcar automáticamente como vencido si corresponde
     */
    public function checkAndUpdateStatus(): void
    {
        if ($this->isOverdue() && $this->status !== 'cumplido') {
            $this->update(['status' => 'vencido']);
        }
    }
}

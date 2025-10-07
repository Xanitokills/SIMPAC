<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sectorista extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'employee_code',
        'name',
        'email',
        'phone',
        'department',
        'position',
        'status',
        'registered_by',
        'registered_at',
        'notes',
    ];

    protected $casts = [
        'registered_at' => 'datetime',
    ];

    /**
     * Relación con el usuario que registró
     */
    public function registeredBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'registered_by');
    }

    /**
     * Relación con asignaciones
     */
    public function assignments(): HasMany
    {
        return $this->hasMany(EntityAssignment::class);
    }

    /**
     * Obtener asignaciones activas
     */
    public function activeAssignments()
    {
        return $this->assignments()->where('status', 'active');
    }

    /**
     * Obtener entidades asignadas actualmente
     */
    public function getAssignedEntities()
    {
        return $this->activeAssignments()->with('entity')->get()->pluck('entity');
    }

    /**
     * Scope para sectoristas activos
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope para sectoristas disponibles (activos y registrados)
     */
    public function scopeAvailable($query)
    {
        return $query->where('status', 'active')
            ->whereNotNull('registered_at');
    }

    /**
     * Verificar si está disponible para asignación
     */
    public function isAvailable(): bool
    {
        return $this->status === 'active' && !is_null($this->registered_at);
    }
}


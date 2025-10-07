<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Entity extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'type',
        'description',
        'status',
    ];

    /**
     * Relación con asignaciones
     */
    public function assignments(): HasMany
    {
        return $this->hasMany(EntityAssignment::class);
    }

    /**
     * Obtener asignación activa
     */
    public function activeAssignment()
    {
        return $this->hasOne(EntityAssignment::class)
            ->where('status', 'active')
            ->latest();
    }

    /**
     * Obtener sectorista actual
     */
    public function getCurrentSectorista()
    {
        return $this->activeAssignment?->sectorista;
    }

    /**
     * Scope para entidades activas
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope para entidades por sector
     */
    public function scopeBySector($query, $sector)
    {
        return $query->where('sector', $sector);
    }

    /**
     * Scope para entidades sin asignar
     */
    public function scopeUnassigned($query)
    {
        return $query->whereDoesntHave('assignments', function ($q) {
            $q->where('status', 'active');
        });
    }
}

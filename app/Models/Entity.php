<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Entity extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'type',
        'sector',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    /**
     * Relación con las asignaciones de esta entidad
     */
    public function assignments(): HasMany
    {
        return $this->hasMany(EntityAssignment::class);
    }

    /**
     * Scope para entidades activas
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope para entidades por tipo
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }
}

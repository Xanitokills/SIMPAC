<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sectorista extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    /**
     * Relación con las asignaciones de este sectorista
     */
    public function assignments(): HasMany
    {
        return $this->hasMany(EntityAssignment::class);
    }

    /**
     * Scope para sectoristas activos
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}

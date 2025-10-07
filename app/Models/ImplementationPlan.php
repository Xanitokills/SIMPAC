<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImplementationPlan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'resolution_type',
        'resolution_number',
        'name',
        'description',
        'pdf_path',
        'start_date',
        'end_date',
        'status',
        'approved_by',
        'approved_at',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'approved_at' => 'datetime',
    ];

    /**
     * Verifica si existe un plan activo
     */
    public static function hasActivePlan(): bool
    {
        return self::where('status', 'active')
            ->whereNull('end_date')
            ->exists();
    }

    /**
     * Obtiene el plan activo actual
     */
    public static function getActivePlan(): ?self
    {
        return self::where('status', 'active')
            ->whereNull('end_date')
            ->first();
    }

    /**
     * Relación con el usuario que aprobó
     */
    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Scope para planes activos
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active')->whereNull('end_date');
    }

    /**
     * Scope para planes expirados
     */
    public function scopeExpired($query)
    {
        return $query->where('status', 'expired')->whereNotNull('end_date');
    }
}

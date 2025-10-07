<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ImplementationPlan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'resolution_number',
        'resolution_type',
        'plan_name',
        'description',
        'pdf_path',
        'resolution_pdf_path',
        'start_date',
        'end_date',
        'year',
        'status',
        'approved_by',
        'approved_at',
        'closure_reason',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'approved_at' => 'datetime',
        'year' => 'integer',
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
     * Obtiene planes agrupados por año para timeline
     */
    public static function getTimeline()
    {
        return self::orderBy('year', 'desc')
            ->orderBy('start_date', 'desc')
            ->get()
            ->groupBy('year');
    }

    /**
     * Relación con el usuario que aprobó
     */
    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Relación con entidades
     */
    public function entities(): HasMany
    {
        return $this->hasMany(Entity::class);
    }

    /**
     * Relación con asignaciones
     */
    public function assignments(): HasMany
    {
        return $this->hasMany(EntityAssignment::class);
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

    /**
     * Obtener duración en años
     */
    public function getDurationInYearsAttribute(): string
    {
        if (!$this->end_date) {
            return 'Vigente desde ' . $this->start_date->format('Y');
        }
        
        $years = $this->start_date->diffInYears($this->end_date);
        $months = $this->start_date->diffInMonths($this->end_date) % 12;
        
        if ($years > 0) {
            return $years . ' año' . ($years > 1 ? 's' : '') . ($months > 0 ? ' y ' . $months . ' mes' . ($months > 1 ? 'es' : '') : '');
        }
        
        return $months . ' mes' . ($months > 1 ? 'es' : '');
    }
}

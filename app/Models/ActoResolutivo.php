<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActoResolutivo extends Model
{
    use SoftDeletes;

    protected $table = 'actos_resolutivos';

    protected $fillable = [
        'oficio_id',
        'resolution_number',
        'resolution_date',
        'document_path',
        'notes',
        'uploaded_by',
    ];

    protected $casts = [
        'resolution_date' => 'date',
    ];

    /**
     * Relación con el oficio
     */
    public function oficio(): BelongsTo
    {
        return $this->belongsTo(Oficio::class);
    }

    /**
     * Relación con las sesiones de inducción
     */
    public function inductionSessions(): HasMany
    {
        return $this->hasMany(InductionSession::class);
    }

    /**
     * Relación con el usuario que subió el documento
     */
    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /**
     * Obtener la URL del documento
     */
    public function getDocumentUrlAttribute(): string
    {
        return asset('storage/' . $this->document_path);
    }
}

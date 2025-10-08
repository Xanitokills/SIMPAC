<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MeetingHistory extends Model
{
    protected $table = 'meeting_history';

    protected $fillable = [
        'meeting_id',
        'subject',
        'scheduled_date',
        'meeting_link',
        'change_type',
        'reason',
        'changed_by',
    ];

    protected $casts = [
        'scheduled_date' => 'datetime',
    ];

    /**
     * Relación con la reunión
     */
    public function meeting(): BelongsTo
    {
        return $this->belongsTo(Meeting::class);
    }

    /**
     * Relación con el usuario que realizó el cambio
     */
    public function changedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}

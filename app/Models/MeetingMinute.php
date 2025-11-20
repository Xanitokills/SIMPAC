<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MeetingMinute extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'entity_assignment_id',
        'minute_number',
        'date',
        'subject',
        'component',
        'status',
        'pdf_path',
        'created_by'
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function entityAssignment(): BelongsTo
    {
        return $this->belongsTo(EntityAssignment::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Downtime extends Model
{
    //

    protected $table = 'downtime';
    public $timestamps = false;

    protected $fillable = [
        'wo_number',
        'downtime_reason',
        'start_time',
        'end_time',
        'duration_minutes',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'duration_minutes' => 'integer',
    ];

    public function machine(): BelongsTo
    {
        return $this->belongsTo(Machine::class, 'machine_code', 'machine_code');
    }
}

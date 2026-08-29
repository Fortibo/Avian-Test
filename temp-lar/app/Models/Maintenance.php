<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    //
    protected $table = 'maintenance';

    protected $primaryKey = 'maintenance_no';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'maintenance_no',
        'machine_code',
        'maintenance_type',
        'start_time',
        'finish_time',
        'duration_minutes',
        'technician',
        'status',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'finish_time' => 'datetime',
        'duration_minutes' => 'integer',
    ];

    public function machine()
    {
        return $this->belongsTo(
            Machine::class,
            'machine_code',
            'machine_code'
        );
    }
}

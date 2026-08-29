<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductionResult extends Model
{
    //

    protected $table = 'production_result';
    public $timestamps = false;
    protected $fillable = [
        'wo_number',
        'actual_start',
        'actual_finish',
        'runtime_minutes',
        'good_qty',
        'reject_qty',
        'achievent',

    ];

    protected $casts = [
        'actual_start' => 'datetime',
        'actual_finish' => 'datetime',
        'runtime_minutes' => 'integer',
        'good_qty' => 'integer',
        'reject_qty' => 'integer',
        'achievent' => 'decimal:2',
    ];

    public function workOrders(): BelongsTo
    {
        return $this->belongsTo(WorkOrder::class, 'wo_number', 'wo_number');
    }
}

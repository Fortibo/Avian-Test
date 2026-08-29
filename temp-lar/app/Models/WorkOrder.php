<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkOrder extends Model
{
    //

    protected $table = 'work_order';
    protected $primaryKey = 'wo_number';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
        'wo_number',
        'product_code',
        'machine_code',
        'employee_no',
        'shift',
        'target_qty',
        'plan_start',
        'plan_finish',
        'status',
    ];

    protected $casts = [
        'plan_start' => 'datetime',

        'plan_finish' => 'datetime',
        'target_qty' => 'integer',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_code', 'product_code');
    }

    public function machine(): BelongsTo
    {
        return $this->belongsTo(Machine::class, 'machine_code', 'machine_code');
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_no', 'employee_no');
    }

    public function productionResults(): HasMany
    {
        return $this->hasMany(ProductionResult::class, 'wo_number', 'wo_number');
    }
    public function downTimes(): HasMany
    {
        return $this->hasMany(DownTime::class, 'wo_number', 'wo_number');
    }
}

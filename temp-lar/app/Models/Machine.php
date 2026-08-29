<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Machine extends Model
{
    //

    protected $table = 'machine';
    protected $primaryKey = 'machine_code';

    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'machine_code',
        'machine_name',
        'production_status',

    ];

    public function workOrders(): HasMany
    {
        return $this->hasMany(WorkOrder::class, 'machine_code', 'machine_code');
    }

    public function maintenances(): HasMany
    {
        return $this->hasMany(Maintenance::class, 'machine_code', 'machine_code');
    }
}

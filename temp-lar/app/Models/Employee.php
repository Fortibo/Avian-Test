<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    //
    protected $table = 'employee';
    protected $primaryKey = 'employee_no';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'employee_no',
        'full_name',
    ];


    public function workOrders(): HasMany
    {
        return $this->hasMany(WorkOrder::class, 'employee_no', 'employee_no');
    }
}

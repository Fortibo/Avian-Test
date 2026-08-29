<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    //

    protected $table = 'product';
    protected $primaryKey = 'product_code';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'product_code',
        'product_name',
        'category',
        'target_min',
        'target_max',
    ];

    public function workOrders(): HasMany
    {
        return $this->hasMany(WorkOrder::class, 'product_code', 'product_code');
    }
}

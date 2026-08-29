<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryTransaction extends Model
{
    //

    protected $table = 'inventory_transaction';
    protected $primaryKey = 'transaction_no';

    public $incrementing = false;

    public $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'transaction_no',
        'transaction_date',
        'material_name',
        'transaction_type',
        'quantity',
        'stock_after',
        'supplier',
    ];

    protected $casts = [
        'transaction_date' => 'datetime',
        'quantity' => 'integer',
        'stock_after' => 'integer',
    ];
}

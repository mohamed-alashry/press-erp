<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Supply extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'supplies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'supplier_id',
        'name',
        'date',
        'price',
        'quantity',
        'base_price',
        'discount',
        'total_price',
        'notes',
    ];

    /**
     * Get the supplier that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'supplier_id');
    }
}

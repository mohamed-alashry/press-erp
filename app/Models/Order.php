<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
        'desc',
        'quantity',
        'total_price',
        'notes',
    ];

    /**
     * Get the client that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    /**
     * Get all of the colors for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function colorItems(): HasMany
    {
        return $this->hasMany(OrderColor::class, 'order_id');
    }
}

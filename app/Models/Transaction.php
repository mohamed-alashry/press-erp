<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transactionable_type',
        'transactionable_id',
        'amount',
        'type',
        'prev_balance',
        'current_balance',
        'action_by',
        'desc',
    ];

    /**
     * Get the parent transactionable model.
     */
    public function transactionable()
    {
        return $this->morphTo();
    }
}

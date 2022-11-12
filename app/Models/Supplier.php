<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'suppliers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'phone',
    ];

    /**
     * Get all of the supplies for the Client
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function supplies(): HasMany
    {
        return $this->hasMany(Supply::class, 'supplier_id');
    }

    /**
     * Get all of the payments for the Client
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany(SupplierPayment::class, 'supplier_id');
    }
}

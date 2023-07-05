<?php

namespace App\Models;

use App\Models\AccountHead;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The "booted" method of the model.
     *
     * This method is called automatically by Eloquent when the model is booted.
     * It registers event listeners for the created and updated events of the Transaction model.
     * Whenever a transaction is created or updated, it triggers the updateAccountHeadTotal method.
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($transaction) {
            $transaction->updateAccountHeadTotal();
        });

        static::updated(function ($transaction) {
            $transaction->updateAccountHeadTotal();
        });
    }

    /**
     * Update the total_amount for the associated account head.
     *
     * This method is called when a transaction is created or updated.
     * It retrieves the associated account head and calls the updateTotalAmount method to update the total_amount.
     */
    public function updateAccountHeadTotal()
    {
        $this->accountHead->updateTotalAmount();
    }

    /**
     * Get the account head associated with the transaction.
     */
    public function accountHead()
    {
        return $this->belongsTo(AccountHead::class);
    }
}

<?php

namespace App\Models;

use App\Models\Group;
use App\Models\Transaction;
use App\Models\AccountHeadTotal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccountHead extends Model
{
    use HasFactory;

    /**
     * Get the group associated with the account head.
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * Update the total amount for the account head.
     */
    public function updateTotalAmount()
    {
        // Calculate the total amount by summing the debit and credit values of transactions
        $totalAmount = $this->transactions()->sum('debit') - $this->transactions()->sum('credit');

        // Retrieve the existing account head total or create a new one
        $accountHeadTotal = $this->accountHeadTotal ?? new AccountHeadTotal();
        $accountHeadTotal->total_amount = $totalAmount;

        // Save the account head total
        $this->accountHeadTotal()->save($accountHeadTotal);
    }

    /**
     * Get the account head total associated with the account head.
     */
    public function accountHeadTotal()
    {
        return $this->hasOne(AccountHeadTotal::class);
    }

    /**
     * Get the transactions associated with the account head.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}

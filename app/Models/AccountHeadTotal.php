<?php

namespace App\Models;

use App\Models\AccountHead;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccountHeadTotal extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'account_head_totals';

    /**
     * Get the account head associated with the account head total.
     */
    public function accountHead()
    {
        return $this->belongsTo(AccountHead::class);
    }
}

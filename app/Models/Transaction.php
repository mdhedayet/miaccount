<?php

namespace App\Models;

use App\Models\AccountHead;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    public function accountHead()
    {
        return $this->belongsTo(AccountHead::class);
    }
}

<?php

namespace App\Models;

use App\Models\Group;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccountHead extends Model
{
    use HasFactory;

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}

<?php

namespace App\Models;

use App\Models\AccountHead;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;

    /*
    *  This is a Group of Account Heads
    */
    public function accountHeads()
    {
        return $this->hasMany(AccountHead::class)
        ->withCount(['transactions as total_amounts' => function ($query) {
            $query->select(DB::raw("SUM(debit) - SUM(credit) as total_amounts"));
        }]);
    }

    /*
    *   This is a Sub Group of a Group
    */
    public function subGroups()
    {
        return $this->hasMany(Group::class, 'parent_id')->where('level', 2);
    }

    /*
    *   This is a Child Group of a Sub Group
    */
    public function childGroups()
    {
        return $this->hasMany(Group::class, 'parent_id')->where('level', 3);
    }

}

<?php

namespace App\Models;

use App\Models\AccountHead;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;

    /**
     * Get the account heads associated with the group and calculate the sum of total_amount.
     */
    public function accountHeads()
    {
        return $this->hasMany(AccountHead::class)->withSum('accountHeadTotal', 'total_amount');
    }

    /**
     * Get the sub groups of the group with a level of 2.
     */
    public function subGroups()
    {
        return $this->hasMany(Group::class, 'parent_id')->where('level', 2);
    }

    /**
     * Get the child groups of the sub group with a level of 3.
     */
    public function childGroups()
    {
        return $this->hasMany(Group::class, 'parent_id')->where('level', 3);
    }
}

<?php

namespace App\Http\Controllers\Api\V1\Account;

use App\Models\Group;
use App\Models\AccountHead;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\GroupResource;
use App\Http\Resources\AccountTotalAmountResource;

class AccountController extends Controller
{
    /*
    * Total amounts hierarchical view
    */
    public function totalAmountsReport()
    {
        // Retrieve the data with relationships and pagination
        $data = Group::with(['subGroups.childGroups.accountHeads'])
            ->where('level', 1)
            ->paginate(10);

        // Process the data and add total amounts at each level
        $data->data = $data->map(function ($item) {
            $item->sub_groups = $item->subGroups?->map(function ($item) {
                $item->child_groups = $item->childGroups->map(function ($item) {
                    // Calculate total amount for child group
                    $item->total_amounts = $item->accountHeads?->sum('accountHeadTotal.total_amount');
                    return $item;
                });
                // Calculate total amount for sub group
                $item->total_amounts = $item->accountHeads?->sum('accountHeadTotal.total_amount') + $item->child_groups->sum('total_amounts');
                return $item;
            });
            // Calculate total amount for the main group
            $item->total_amounts = $item->accountHeads?->sum('accountHeadTotal.total_amount') + $item->sub_groups->sum('total_amounts');
            return $item;
        });

        return GroupResource::collection($data);
    }

    /*
    * Total amounts table view
    */
    public function totalAmountsTableReport()
    {
        // Retrieve the data with relationships and pagination
        $results = AccountHead::select([
            'account_heads.id AS account_head_id',
            DB::raw('CASE
            WHEN g3_level_one.id IS NOT NULL THEN g3_level_one.id
            ELSE COALESCE(g3_parent.id, COALESCE(g2_parent.id, g1.id))
            END AS group_level_1_id'),

            DB::raw('CASE
            WHEN g3_level_one.id IS NOT NULL THEN g3_level_one.name
            ELSE COALESCE(g3_parent.name, COALESCE(g2_parent.name, g1.name))
            END AS group_level_1'),

            DB::raw('CASE
            WHEN g3.id IS NOT NULL THEN g3_parent.name
            ELSE g2.name
            END AS group_level_2'),

            'g3.name AS group_level_3',
            'account_heads.name AS account_head_name',

            DB::raw('COALESCE(ath.total_amount, 0) AS total')
        ])
            ->leftJoin('groups AS g1', 'account_heads.group_id', '=', 'g1.id')
            ->leftJoin('groups AS g2', function ($join) {
                $join->on('account_heads.group_id', '=', 'g2.id')
                    ->where('g2.level', '=', 2);
            })
            ->leftJoin('groups AS g2_parent', 'g2.parent_id', '=', 'g2_parent.id')
            ->leftJoin('groups AS g3', function ($join) {
                $join->on('account_heads.group_id', '=', 'g3.id')
                    ->where('g3.level', '=', 3);
            })
            ->leftJoin('groups AS g3_parent', 'g3.parent_id', '=', 'g3_parent.id')
            ->leftJoin('groups AS g3_level_two', 'g3.parent_id', '=', 'g3_level_two.id')
            ->leftJoin('groups AS g3_level_one', 'g3_level_two.parent_id', '=', 'g3_level_one.id')
            ->leftJoin('account_head_totals AS ath', 'account_heads.id', '=', 'ath.account_head_id')
            ->orderBy('group_level_1_id', 'ASC')
            ->paginate(10);

        return AccountTotalAmountResource::collection($results);
    }
}

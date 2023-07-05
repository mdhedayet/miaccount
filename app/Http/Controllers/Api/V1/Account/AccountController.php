<?php

namespace App\Http\Controllers\Api\V1\Account;

use App\Models\Group;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\GroupResource;

class AccountController extends Controller
{
    /*
    *total amounts  hierarchical view
    */
    public function totalAmountsReport()
    {
        $data = Group::with(['subGroups'=>function($query){
            $query->with(['childGroups'=>function($query){
                $query->with(['accountHeads']);
            },'accountHeads']);
        },'accountHeads'])->where('level', 1)->paginate(2);

        $data->data = $data->map(function($item){
            $item->sub_groups = $item->subGroups?->map(function($subGroup){
                $subGroup->child_groups = $subGroup->childGroups?->map(function($childGroup){
                    $childGroup->total_amounts = $childGroup->accountHeads?->sum('total_amounts');
                    return $childGroup;
                });
                $subGroup->total_amounts = $subGroup->accountHeads?->sum('total_amounts')+ $subGroup->child_groups?->sum('total_amounts');
                return $subGroup;
            });
            $item->total_amounts = $item->accountHeads?->sum('total_amounts') + $item->sub_groups?->sum('total_amounts');
            return $item;
        });

        return GroupResource::collection($data);
    }

    /*
    *total amounts table view
    */
    public function totalAmountsTableReport()
    {
        $query = "SELECT
        ah.id AS account_head_id,
        CASE
           WHEN g3_level_one.id IS NOT NULL THEN g3_level_one.id
           ELSE COALESCE(g3_parent.id, COALESCE(g2_parent.id, g1.id))
        END AS group_level_1_id,
        CASE
           WHEN g3_level_one.id IS NOT NULL THEN g3_level_one.name
           ELSE COALESCE(g3_parent.name, COALESCE(g2_parent.name, g1.name))
        END AS group_level_1,
        CASE
           WHEN g3.id IS NOT NULL THEN g3_parent.name
           ELSE g2.name
        END AS group_level_2,
        g3.name AS group_level_3,
        ah.name AS account_head_name,
        COALESCE(t.total, 0) AS total
        FROM
            account_heads ah
        LEFT JOIN
            `groups` g1 ON ah.group_id = g1.id
        LEFT JOIN
            `groups` g2 ON ah.group_id = g2.id   AND g2.level = 2
        LEFT JOIN
            `groups` g2_parent ON g2.parent_id = g2_parent.id
        LEFT JOIN
            `groups` g3 ON ah.group_id = g3.id AND g3.level = 3
        LEFT JOIN
            `groups` g3_parent ON g3.parent_id = g3_parent.id
        LEFT JOIN
            `groups` g3_level_two ON g3.parent_id = g3_level_two.id
        LEFT JOIN
            `groups` g3_level_one ON g3_level_two.parent_id = g3_level_one.id
        LEFT JOIN
            (
                SELECT
                    account_head_id,
                    SUM(debit) - SUM(credit) AS total
                FROM
                    transactions
                GROUP BY
                    account_head_id
            ) t ON ah.id = t.account_head_id
        ORDER BY `group_level_1_id` ASC";

        $result = DB::select($query);
        return response()->json($result);
    }
}

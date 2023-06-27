<?php

namespace App\Http\Resources;

use App\Http\Resources\AccountHeadResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'level' => $this->level,
            'parent_id' => $this->parent_id,
            'total_amounts' => $this->whenLoaded('accountHeads', function () {
                return $this->accountHeads->sum('total_amounts')
                +
                $this->subGroups->sum(function ($subGroup) {
                    return $subGroup->accountHeads->sum('total_amounts') + $subGroup->childGroups->sum(function ($childGroup) {
                        return $childGroup->accountHeads->sum('total_amounts');
                    });
                })
                +
                $this->childGroups->sum(function ($childGroup) {
                    return $childGroup->accountHeads->sum('total_amounts');
                });
            }),
            'account_heads_id' => $this->whenLoaded('accountHeads', function () {
                return $this->accountHeads->pluck('id');
            }),
            'sub_groups' => GroupResource::collection($this->whenLoaded('subGroups')),
            'account_heads' => AccountHeadResource::collection($this->whenLoaded('accountHeads')),
            'child_groups' => GroupResource::collection($this->whenLoaded('childGroups')),
        ];
    }
}

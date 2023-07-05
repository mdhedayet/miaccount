<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AccountTotalAmountResource extends JsonResource
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
            'account_head_id'   => $this->account_head_id,
            'group_level_1_id'  => $this->group_level_1_id,
            'group_level_1'     => $this->group_level_1,
            'group_level_2'     => $this->group_level_2,
            'group_level_3'     => $this->group_level_3,
            'account_head_name' => $this->account_head_name,
            'total'             => (int) $this->total,
        ];
    }
}

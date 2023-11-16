<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[

            'name' => $this->company_name,
            'owner'=> $this->company_owner,
            'created_at'=> date_format(date_create($this->company_created_at),'y-m-d h:i:s'),
            'manager'=> $this->manager_name,
            'branches'=> $this->branches,


        ];


        // return parent::toArray($request);
    }
}

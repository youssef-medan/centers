<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            "name"=> $this->branch_name,
            "location"=> $this->location,
            "mobile"=> $this->mobile,
            "company"=> $this->company_name,
            "created_at"=> $this->branch_created_at,
        ];
        // return parent::toArray($request);
    }
}

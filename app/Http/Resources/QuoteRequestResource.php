<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuoteRequestResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'related_sites' => $this->related_sites,
            'business_name' => $this->business_name,
            'business_type' => $this->business_type,
            'project_type' => $this->project_type,
            'estimate' => $this->estimate,
            'project_description' => $this->project_description,
            'way_of_knowing' => $this->way_of_knowing,
            'is_dispatched' => $this->is_dispatched ? 'Despachado' : 'No despachado',
            'created_at' => $this->created_at->isoFormat('DD MMMM, YYYY [a las] h:mm A'),
        ];
    }
}

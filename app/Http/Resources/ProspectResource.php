<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProspectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'prospect_name' => $this->prospect_name,
            'company' => $this->company,
            'project_type' => $this->project_type,
            'notes' => $this->notes,
            'is_aproved' => $this->is_aproved,
            'user' => $this->whenLoaded('user'),
            'created_at' => $this->created_at?->isoFormat('DD MMMM, YYYY [a las] h:mm A'),
            'updated_at' => $this->updated_a?->isoFormat('DD MMMM, YYYY [a las] h:mm A'),
        ];
    }
}

<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'name' => $this->name,
            'key' => $this->key,
            'customer_info' => $this->client_info,
            'description' => $this->description,
            'start_date' => $this->start_date?->isoFormat('DD MMM, YYYY'),
            'finish_date' => $this->finish_date?->isoFormat('DD MMM, YYYY'),
            'state' => $this->state,
            'price' => $this->price,
            'user' => $this->whenLoaded('user'),
            'created_at' => $this->created_at?->isoFormat('DD MMM, YYYY'),
            'updated_at' => $this->updated_at?->isoFormat('DD MMM, YYYY'),
        ];
    }
}

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
            'hours_work' => $this->hours_work,
            'cuote' => number_format($this->cuote),
            'client_info' => $this->client_info,
            'promisse_finish_date' =>Carbon::parse($this->promisse_finish_date)?->isoFormat('DD MMM YYYY'),
            'message' => $this->whenLoaded('message'),
            'user' => $this->whenLoaded('user'),
            'created_at' => $this->created_at?->isoFormat('DD MMM YYYY'),
            'updated_at' => $this->updated_at?->isoFormat('DD MMM YYYY'),
        ];
    }
}

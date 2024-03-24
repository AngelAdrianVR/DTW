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
            'customer_info' => $this->customer_info,
            'description' => $this->description,
            'hours_work' => $this->hours_work,
            'start_date' => $this->start_date?->isoFormat('DD MMM, YYYY'),
            'finish_date' => $this->finish_date?->isoFormat('DD MMM, YYYY'),
            'state' => $this->state,
            'price' => [
                    'formated' => '$' .  number_format($this->price),
                    'raw' => $this->price
            ],
            'payment_method' => $this->payment_method,
            'estimated_date' => $this->estimated_date?->isoFormat('DD MMM, YYYY'),
            'category' => $this->category,
            'invoice' => $this->invoice,
            'responsible' => $this->whenLoaded('responsible'),
            'client' => $this->whenLoaded('client'),
            'quote' => $this->whenLoaded('quote'),
            'user' => $this->whenLoaded('user'),
            'tasks' => ProjectTaskResource::collection($this->whenLoaded('tasks')),
            'media' => $this->getMedia('media')->all(),
            'created_at' => $this->created_at?->isoFormat('DD MMM, YYYY'),
            'updated_at' => $this->updated_at?->isoFormat('DD MMM, YYYY'),
        ];
    }
}

<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email' => $this->email,
            'is_active' => $this->is_active,
            'employee_properties' => $this->employee_properties,
            'emergency_contact' => $this->emergency_contact,
            'profile_photo_url' => $this->profile_photo_url,
            'last_access' => $this->last_access?->diffForHumans(),
            'created_at' => $this->created_at?->isoFormat('DD MMMM, YYYY'),
            'updated_at' => $this->updated_at?->isoFormat('DD MMMM, YYYY'),
        ];
    }
}

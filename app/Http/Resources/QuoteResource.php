<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuoteResource extends JsonResource
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
            'customer_name' => $this->customer_name,
            'company' => $this->name,
            'company_address' => $this->company_address,
            'project' => $this->project,
            'email' => $this->email,
            'included_features' => $this->included_features,
            'total_work_days' => $this->total_work_days,
            'suggested_features' => $this->suggested_features,
            'percentage_discount' => $this->percentage_discount,
            'advance_payment_percentage' => $this->advance_payment_percentage,
            'total_hours' => $this->total_hours,
            'total_cost' => $this->total_cost,
            'promised_end_date' => $this->promised_end_date?->isoFormat('DD MMMM, YYYY'),
            'offer_validity_days' => $this->offer_validity_days,
            'user' => $this->whenLoaded('user'),
            'created_at' => $this->created_at?->isoFormat('DD MMMM, YYYY [a las] h:mm A'),
            'updated_at' => $this->updated_at?->isoFormat('DD MMMM, YYYY [a las] h:mm A'),
        ];
    }
}

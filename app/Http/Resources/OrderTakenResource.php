<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderTakenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        dd($this->shift);
        return [
            'id' => $this->id,
            'table' => $this->table->name,
            'shift_workers' => $this->shift->name,
            'created_at' => $this->created_at,
            'status' => $this->statusOrder->name,
        ];
    }
}

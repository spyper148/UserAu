<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdersContentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->order->id,
            'table' => $this->order->table->name,
            'shift_workers' => $this->order->user->name,
            'created_at' => $this->order->created_at,
            'status'=> $this->order->statusOrder->name,
            'price'=> $this->product->sum('price'),
        ];
    }
}

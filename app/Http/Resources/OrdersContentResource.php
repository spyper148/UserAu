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
        dd($this->order->product);
        return [
            'id' => $this->id,
            'table' => $this->table->name,
            'shift_workers' => $this->user->name,
            'created_at' => $this->created_at,
            'status'=> $this->statusOrder->name,
            'price'=> $this->order->product->price,

        ];
    }
}

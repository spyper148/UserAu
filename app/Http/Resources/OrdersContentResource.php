<?php

namespace App\Http\Resources;

use App\Models\OrderList;
use App\Models\Product;
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

        $products = OrderList::where('order_id',$this->id)->get();
        $price = 0;
        foreach ($products as $product)
        {
            $price+=$product->product->price;

        }
        return [
            'id' => $this->id,
            'table' => $this->table->name,
            'shift_workers' => $this->user->name,
            'created_at' => $this->created_at,
            'status'=> $this->statusOrder->name,
            'price'=> $price,

        ];
    }
}

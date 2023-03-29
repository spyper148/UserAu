<?php

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AcceptOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $price_all=0;
        $order = Order::where('id',$this->id)->first();
        $order_list=$order->order;
        foreach ($order_list as $item)
        {
            $price = $item->product->price;
            $count = $item->count;
            $price_all+=($price*$count);
        }
        return [
          'id' => $this->id,
          'table' => $this->table->name,
          'shift_workers' => $this->user->name,
          'create_at' => $this->created_at,
            'status'=>$this->statusOrder->name,
            'positions'=> OrderPositionResource::collection($this->order),
            'price_all'=>$price_all,
        ];
    }
}

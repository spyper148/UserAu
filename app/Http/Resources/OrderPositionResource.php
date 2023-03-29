<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderPositionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $first_price =$this->product->price;
        $count = $this->count;
        $price = $first_price*$count;
        return [
            'id'=>$this->id,
            'count'=>$this->count,
            'position'=>$this->product->name,
            'price'=>$price,
        ];
    }
}

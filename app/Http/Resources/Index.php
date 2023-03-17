<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use function Nette\Utils\data;

class Index extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public static $wrap = 'data';
    public function toArray(Request $request): array
    {
       return
           [
               'id'=>$this->id,
               'name'=>$this->name,
               'login'=>$this->login,
               'status'=>$this->status->status,
               'group'=>$this->group->name,

           ];

    }

}

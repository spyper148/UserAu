<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AcceptOrderResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderTakenResource;
use App\Http\Resources\SetStatusResource;
use App\Http\Resources\ShiftOrdersResource;
use App\Models\Order;
use App\Models\StatusOrder;
use App\Models\User;
use App\Models\UserOnShift;
use App\Models\WorkShift;
use Illuminate\Http\Request;
use function Psy\sh;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $waiter = User::where('api_token',$request->bearerToken())->first();
        $shift = UserOnShift::where('shift_id',$request->work_shift_id)->get();
        $waiter_on_shift = false;
        $shift_active=false;
        foreach ($shift as $item)
        {
            if($item->user_id==$waiter->id)
            {
                $waiter_on_shift=true;
            }
            $shift_active = $item;
        }
        if($waiter_on_shift==true)
        {
            if($shift_active==true)
            {
                $order=Order::forceCreate([
                   'table_id' => $request->table_id,
                    'work_shift_id' => $request->work_shift_id,
                    'user_id' => $waiter->id,
                    'status_order_id' => 2,
                    'number_of_person' => $request->number_of_person,
                ]);
                return response(new OrderResource($order), 200);
            }
            return response(['error'=>['code'=>403,'message'=>'Forbidden. The shift must be active!']]);
        }
        return response(['error'=>['code'=>403,'message'=>'Forbidden. You dont work this shift!']]);
    }

    public function order(Request $request)
    {
        $waiter = User::where('api_token',$request->bearerToken())->first();
        $order=Order::where('id',$request->id)->first();
        if($order->user_id==$waiter->id)
        {
            $order=Order::where('id',$request->id)->first();
            return response(new AcceptOrderResource($order),200);
        }
        return response(['error'=>['code'=>403,'message'=>'Forbidden. You did not accept this order!']]);

    }

    public function setStatus(Request $request,$id)
    {

        $waiter = User::where('api_token',$request->bearerToken())->first();
        $order=Order::where('id',$request->id)->first();
        $status = StatusOrder::where('name',$request->status)->first();
        $shift = WorkShift::where('id',$order->work_shift_id)->first();
        if(isset($order))
        {
            if($shift->active == true)
            {
                if($order->user_id==$waiter->id)
                {
                    if(isset($status))
                    {
                        $order->status_order_id=$status->id;
                        $order->save();
                        return response(new SetStatusResource($order),200);
                    }
                    return response(['error'=>['code'=>403,'message'=>'Forbidden! Can`t change existing order status']]);
                }
                return response(['error'=>['code'=>403,'message'=>'Forbidden! You did not accept this order!']]);
            }
            return response(['error'=>['code'=>403,'message'=>'You cannot change the order status of a closed shift!']]);

        }

    }

    public function orderTaken()
    {
        $status_accept = StatusOrder::where('name','Принят')->first();
        $status_cook = StatusOrder::where('name','Готовится')->first();
       $orders = Order::where('status_order_id',$status_accept->id)->orWhere('status_order_id', $status_cook->id)->first();
       return response(new OrderTakenResource($orders),200);
    }
}

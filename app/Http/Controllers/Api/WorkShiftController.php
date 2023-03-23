<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OpenCloseWorkShiftResource;
use App\Http\Resources\ShiftOrdersResource;
use App\Http\Resources\WorkShiftResource;
use App\Models\Order;
use App\Models\OrderList;
use App\Models\WorkShift;
use Illuminate\Http\Request;

class WorkShiftController extends Controller
{

    public function store(Request $request)
    {
        $work_shift = WorkShift::forceCreate([
            'start'=>$request['start'],
            'end'=>$request['end'],
            'active'=>false,
        ]);
        return response(new WorkShiftResource($work_shift),200);
    }

    public function openShift(Request $request)
    {
        $active_shifts = WorkShift::query()->where('active','=',true)->first();
        if(isset($active_shifts))
        {
            return response(['error'=>['code'=>403,'message'=>'Forbidden. There are open shifts!']]);

        }
        else
        {
            $shift=WorkShift::query()->where('id','=',$request->id)->first();
            $shift->update(['active'=>true]);
            return response(new OpenCloseWorkShiftResource($shift),200);
        }


    }

   public function closeShift(Request $request)
    {
        $close_shift = WorkShift::query()->where('id','=',$request->id)->first();
        if($close_shift->active==0)
        {
            return response(['error'=>['code'=>403,'message'=>'Forbidden. There are close shifts!']]);
        }
        else
        {
            $shift=WorkShift::query()->where('id','=',$request->id)->first();
            $shift->update(['active'=>false]);
            return response(new OpenCloseWorkShiftResource($shift),200);
        }


    }

    public function shiftOrders(Request $request)
    {
      /*  $shift_orders = WorkShift::query()->where('id','=',$request->id);
        return response(new ShiftOrdersResource($shift_orders),200);*/
       /* dd(ShiftOrdersResource::collection(OrderList::all()));*/
        return ShiftOrdersResource::collection(WorkShift::query()->where('id','=',$request->id)->get())->response()->setStatusCode(200);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserOnShiftResource;
use App\Models\UserOnShift;
use Illuminate\Http\Request;

class UserOnShiftController extends Controller
{

    public function store(Request $request)
    {
        $find_user = UserOnShift::query()
            ->where('user_id','=',$request->user_id)
            ->where('shift_id','=',$request->id)
            ->first();

        if(isset($find_user))
        {
            return response(['error'=>['code'=>403,'message'=>'Forbidden. The worker is already on shift!']]);
        }

            $user_on_shift = UserOnShift::forceCreate([
                'shift_id' => $request->id,
                'user_id' => $request->user_id,
            ]);

        return response(new UserOnShiftResource($user_on_shift),200);
    }
}

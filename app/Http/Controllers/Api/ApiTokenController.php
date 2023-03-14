<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Psy\Util\Str;

class ApiTokenController extends Controller
{
    public function update(Request $request)
    {
        $token = Str::random(80);
        $request->user()->forceFill([
            'api_token'=>hash('sha256',$token),
        ])->save();

        return ['token'=>$token];
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiValidation;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\RegistrationResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class UserController extends Controller
{
    protected function store(StoreUserRequest $request)
    {

        $user = User::forceCreate([
           'name'=>$request['name'],
           'surname'=>$request['surname'],
           'patronymic'=>$request['patronymic'],
           'login'=>$request['login'],
           'password'=>Hash::make($request['password']),
           'api_token'=>Str::random(100),
        ]);
        return response(new RegistrationResource($user),201);
    }

    protected function login(LoginRequest $request)
    {
        $user= User::query()->where('login','=', $request->login)->first();
        if(isset($user)){
            if (Hash::check($request['password'], $user->password)){
                $user->api_token = Str::random(100);
                $user->save();
                return response(new LoginResource($user),201);
            }
        }
        return response(['error' => ['code' => 401, 'message' => 'authorization not successful']]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profiles\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileControlller extends Controller
{
    public function show(){
        try{
            $user =  User::firstWhere('id', Auth::id());

            return response()->json($user, 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), $th->getCode());
        }
    }

    public function update(ProfileUpdateRequest $request){
        try{
            $data = $request->validated();
            $user = User::firstWhere('id', Auth::id())->update($data);

            return response()->json($user, 200);
        }catch(\Throwable $th){
            return response()->json($th->getMessage(), $th->getCode());
        }
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthStoreRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(AuthStoreRequest $request):JsonResponse
    {
        try {
            
        $data = $request->validated();

        $user = User::firstwhere('email', $data['email']);
        
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Dados incorretos'], 401);
        }

        $user->tokens()->delete();
        $token = $user->createToken("$user->name - $user->email")->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json($response, 200);
        } catch (\Throwable $th) {
            dd($th);
            return response()->json($th->getMessage(), $th->getCode());
        }
    }

    public function logout(): JsonResponse
    {
        try{
            $user = User::firstWhere('id', Auth::id());
            $user->tokens()->delete();

            return response()->json(['message' => 'Logout efetuado com sucesso!'], 200);
        }
        catch (\Throwable $th) {
            return response()->json($th->getMessage(), $th->getCode());
        }
    }

    public function info(Request $request){
        return $request->user();
    }
}
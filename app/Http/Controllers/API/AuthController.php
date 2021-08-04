<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Auth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $user = $request->only('email', 'password');

        try {
            if (!$token = auth('api')->attempt($user)) {
                return response()->json(['error' => 'Email \ Password Salah!'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token', 'user'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'),201);
    }

    public function logout(Request $request){
        $logout = Auth::guard('api')->logout();

        return response()->json([
            'status' => 'Success Logout'
        ]);
        // $this->validate($request, [
        //     'token' => 'required'
        // ]);

        // try {
        //     JWTAuth::invalidate($request->token);
        //     return response()->json(['message' => 'User logged out successfully']);
        // } catch (JWTException $exception) {
        //     return response()->json(['message' => 'Sorry, the user cannot be logged out'], 500);
        // }

    }
}
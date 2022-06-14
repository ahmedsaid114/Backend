<?php

namespace App\Http\Controllers\API;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role' => 'nullable|string',
            'first_name' => 'required|string',
            'last_name' => 'nullable|string',
            'email' => 'required|email|unique:users',
            'phone' => 'nullable|string|max:11',
            'city' => 'nullable|string',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all()
            ]);
        }

        if(!$request->role){
            $role = Role::where('name', 'user')->first();
        } else {
            $role = Role::where('name', $request->role)->first();
        }

        $user = User::create([
            'role_id' => $role->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'city' => $request->city,
            'password' => Hash::make($request->password),
        ]);

        if (!$token = JWTAuth::fromUser($user)) {
            return response()->json([
                'status' => false,
                'message' => 'User not logged in'
            ]);
        }

        // $token = $user->createToken('authToken');

        return response()->json([
            'status' => true,
            'message' => 'User created successfully',
            'data' => [
                'user' => $user,
                'token' => $token
            ]
        ]);

    }

    public function login (Request $request)
    {
        // $credentials = $request->only('email', 'password');

        // if ($token = auth()->attempt($credentials)) {
        //     return $token;
        // }
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all()
            ]);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Email not found'
            ]);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Password is incorrect'
            ]);
        }

        if(!$token = JWTAuth::fromUser($user)){
            return response()->json([
                'status' => false,
                'message' => 'User not logged in'
            ]);
        }
        // $token = JWTAuth::fromUser($user);

        return response()->json([
            'status' => true,
            'message' => 'User logged in successfully',
            'data' => [
                'user' => $user,
                'token' => $token
            ]
        ]);
    }
}

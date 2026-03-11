<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;


class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'message' => 'Pogrešni kredencijali'
            ], 401);
        }

        if (auth()->user()->role !== 'admin') {
            return response()->json([
                'message' => 'Nemate pristup'
            ], 403);
        }

        return response()->json([
            'message' => 'Uspešna prijava',
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => auth()->user()
        ]);
    }

    public function logout()
    {
        auth('api')->logout();

        return response()->json([
            'message' => 'Uspešno ste se odjavili'
        ]);
    }

    public function me()
    {
        return response()->json([
            'data' => auth()->user()
        ]);
    }
}
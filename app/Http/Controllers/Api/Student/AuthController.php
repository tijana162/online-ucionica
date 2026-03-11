<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Student\RegisterStudentRequest;
use App\Http\Requests\Api\Student\LoginStudentRequest;
class AuthController extends Controller
{
    public function register(RegisterStudentRequest $request)
    {
        $data = $request->validated();

        $student = User::create([
            'ime' => $request->ime,
            'prezime' => $request->prezime,
            'broj_indeksa' => $request->broj_indeksa,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'student'
        ]);

        $token = auth('api')->login($student);

        return response()->json([
            'message' => 'Registracija uspešna',
            'access_token' => $token,
            'user' => $student
        ]);
    }

    public function login(LoginStudentRequest $request)
    {
        $credentials = $request->validated();

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json([
                'message' => 'Pogrešan email ili lozinka'
            ], 401);
        }

        if (auth('api')->user()->role !== 'student') {
            return response()->json([
                'message' => 'Niste student'
            ], 403);
        }

        return response()->json([
            'message' => 'Uspešna prijava.',
            'access_token' => $token,
            'user' => auth('api')->user()
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
        return response()->json(auth('api')->user());
    }
}
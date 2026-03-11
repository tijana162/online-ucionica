<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Admin\StoreAdminRequest;
use App\Models\User;

class AdminController extends Controller
{
     public function store(StoreAdminRequest $request)
    {
        $admin = User::create([
            'korisnicko_ime' => $request->korisnicko_ime,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'admin',
        ]);

        return response()->json([
            'message' => 'Novi admin dodat',
            'data' => $admin
        ], 201);
    }
}

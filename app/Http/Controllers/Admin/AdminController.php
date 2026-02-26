<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index()
{
    $admins = \App\Models\User::where('role', 'admin')->get();
    return view('admin.admins.index', compact('admins'));
}

public function create()
{
    return view('admin.admins.create');
}

public function store(Request $request)
{
    $request->validate([
        'ime' => 'required',
        'prezime' => 'required',
        'korisnicko_ime' => 'required|unique:users',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6'
    ]);

    \App\Models\User::create([
        'ime' => $request->ime,
        'prezime' => $request->prezime,
        'korisnicko_ime' => $request->korisnicko_ime,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => 'admin',
    ]);

    return redirect()->route('admin.admins.index');
}
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

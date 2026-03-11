<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\Api\Admin\StoreStudentRequest;
use App\Http\Requests\Api\Admin\UpdateStudentRequest;
use Illuminate\Http\Request;
class StudentController extends Controller
{
  public function index(Request $request)
{
    $query = User::where('role','student');

    // PRETRAGA po imenu ili prezimenu
    if ($request->has('search')) {
        $search = $request->search;

        $query->where(function($q) use ($search){
            $q->where('ime','like',"%$search%")
              ->orWhere('prezime','like',"%$search%")
              ->orWhere('email','like',"%$search%");
        });
    }

    // SORTIRANJE
    if ($request->has('sort_by')) {
        $sortBy = $request->sort_by;
        $order = $request->get('order','asc');

        $query->orderBy($sortBy,$order);
    }

    // PAGINACIJA
    $students = $query->paginate(10);

    return response()->json([
        'message' => 'Lista studenata',
        'data' => $students
    ]);
    }


    public function store(StoreStudentRequest $request)
    {
        $student = User::create([
            'ime' => $request->ime,
            'prezime' => $request->prezime,
            'broj_indeksa' => $request->broj_indeksa,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'student'
        ]);

        return response()->json([
            'message' => 'Student uspešno kreiran',
            'data' => $student
        ], 201);
    }


    public function show(User $student)
    {
        if ($student->role !== 'student') {
            return response()->json([
                'message' => 'Korisnik nije student'
            ], 404);
        }

        return response()->json([
            'data' => $student
        ], 200);
    }

   
    public function update(UpdateStudentRequest $request, User $student)
    {
        if ($student->role !== 'student') {
            return response()->json([
                'message' => 'Korisnik nije student'
            ], 404);
        }

        $student->update($request->validated());

        return response()->json([
            'message' => 'Student uspešno izmenjen',
            'data' => $student
        ], 200);
    }

  
    public function destroy(User $student)
    {
        if ($student->role !== 'student') {
            return response()->json([
                'message' => 'Korisnik nije student'
            ], 404);
        }

        $student->delete();

        return response()->json([
            'message' => 'Student uspešno obrisan'
        ], 200);
    }
}
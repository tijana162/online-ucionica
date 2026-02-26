<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Course;
class StudentController extends Controller
{
 
    public function index()
    {
        $students = User::where('role', 'student')->get();
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        return view('admin.students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ime' => 'required|string|max:255',
            'prezime' => 'required|string|max:255',
            'korisnicko_ime' => 'required|string|max:255|unique:users,korisnicko_ime',
            'email' => 'required|email|unique:users,email',
            'broj_indeksa' => 'required|string|unique:users,broj_indeksa',
            'password' => 'required|min:6',
        ]);

        User::create([
            'ime' => $request->ime,
            'prezime' => $request->prezime,
            'korisnicko_ime' => $request->korisnicko_ime,
            'email' => $request->email,
            'broj_indeksa' => $request->broj_indeksa, 
            'role' => 'student',
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.students.index')
            ->with('success', 'Student je uspešno dodat.');
    }

    public function show(User $student)
    {
        return view('admin.students.show', compact('student'));
    }


    public function edit(User $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, User $student)
    {
        $request->validate([
            'ime' => 'required|string|max:255',
            'prezime' => 'required|string|max:255',
            'korisnicko_ime' => 'required|string|max:255|unique:users,korisnicko_ime,' . $student->id,
            'email' => 'required|email|unique:users,email,' . $student->id,
             'broj_indeksa' => 'required|string|unique:users,broj_indeksa,' . $student->id,
        ]);

        $student->update([
            'ime' => $request->ime,
            'prezime' => $request->prezime,
            'korisnicko_ime' => $request->korisnicko_ime,
            'email' => $request->email,
            'broj_indeksa' => $request->broj_indeksa,
        ]);

        return redirect()->route('admin.students.index')
            ->with('success', 'Student je uspešno izmenjen.');
    }

    public function destroy(User $student)
    {
        $student->delete();

        return redirect()->route('admin.students.index')
            ->with('success', 'Student je uspešno obrisan.');
    }

    public function enroll(Course $course)
    {
        $student = auth()->user();

        $student->courses()->syncWithoutDetaching([$course->id]);

        return back()->with('success', 'Uspešno prijavljen na kurs.');
    }
    public function unenroll(Course $course)
    {
        auth()->user()->courses()->detach($course->id);
        return back()->with('success', 'Uspešno odjavljen sa kursa.');
    }
    }
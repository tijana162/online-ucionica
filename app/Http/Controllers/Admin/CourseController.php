<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
      $request->validate([
    'semestar' => 'required',
    'sifra' => 'required',
    'profesor' => 'required',
    'opis' => 'required',
]);

        Course::create($request->all());

        return redirect()->route('admin.courses.index')
        ->with('success', 'Kurs je uspešnp dodat.');
    }

    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
    'semestar' => 'required',
    'sifra' => 'required',
    'profesor' => 'required',
    'opis' => 'required',
]);

        $course->update($request->all());

        return redirect()->route('admin.courses.index')
                         ->with('success', 'Kurs je uspešno izmenjen.');
    }

    public function destroy(Course $course)
    {
        $course->students()->detach();
        $course->delete();
        return redirect()->route('admin.courses.index')
                            ->with('success', 'Kurs je usepsno obrisan.');
    }

    public function show(Course $course)
    {
        $allStudents = User::where('role', 'student')->get();
        $course->load('students');
        return view('admin.courses.show', compact('course', 'allStudents'));
    }
public function attachStudent(Request $request, Course $course)
{
    $request->validate([
        'student_id' => 'required|exists:users,id',
    ]);

    $student = User::where('id', $request->student_id)
                   ->where('role', 'student')
                   ->firstOrFail();

    $course->students()->syncWithoutDetaching([$student->id]);

    return back()->with('success', 'Student je uspešno dodat na kurs.');
}

public function detachStudent(Course $course, User $student)
{
    $course->students()->detach($student->id);

    return back()->with('success', 'Student je uspešno uklonjen sa kursa.');
}

}
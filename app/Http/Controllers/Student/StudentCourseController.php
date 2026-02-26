<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;

class StudentCourseController extends Controller
{
    public function index()
{
    $student = auth()->user();
    $courses = Course::all();
    $enrolledCourses = $student->courses;

    return view('student.courses.index', compact('student', 'courses', 'enrolledCourses'));
}
    public function enroll(Course $course)
    {
        $student = auth()->user();

        if (!$student->courses->contains($course->id)) {
            $student->courses()->attach($course->id);
        }

        return back()->with('success', 'Uspešno prijavljen na kurs.');
    }

    public function unenroll(Course $course)
    {
        $student = auth()->user();
        $student->courses()->detach($course->id);

        return back()->with('success', 'Uspešno odjavljen sa kursa.');
    }
}
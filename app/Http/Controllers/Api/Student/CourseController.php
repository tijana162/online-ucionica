<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\User;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::paginate(10);

        return response()->json([
            'data' => $courses
        ]);
    }

    public function show(Course $course)
    {
        return response()->json([
            'data' => $course
        ]);
    }

    public function attach(Course $course)
    {
        $course->students()->syncWithoutDetaching([auth()->id()]);

        return response()->json([
            'message' => 'Uspešno ste prijavljeni na kurs'
        ]);
    }

    public function detach(Course $course)
    {
        $course->students()->detach(auth()->id());

        return response()->json([
            'message' => 'Uspešno ste odjavljeni sa kursa'
        ]);
    }

    public function myCourses(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['message' => 'Nije prijavljen'], 401);
        }

        $courses = $user->courses()->paginate(10);

        return response()->json([
            'message' => 'Lista kurseva na kojima ste prijavljeni',
            'data' => $courses
        ]);
    }
}
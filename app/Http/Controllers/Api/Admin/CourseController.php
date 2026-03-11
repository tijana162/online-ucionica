<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Admin\StoreCourseRequest;
use App\Http\Requests\Api\Admin\UpdateCourseRequest;
class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::paginate(10);

        return response()->json([
            'data' => $courses
        ]);
    }

    public function store(StoreCourseRequest $request)
    {
        $course = Course::create($request->validated());

        return response()->json([
            'message' => 'Kurs dodat',
            'data' => $course
        ], 201);
    }

    public function show(Course $course)
    {
        $course->load('students');

        return response()->json([
            'data' => $course
        ]);
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->update($request->validated());

        return response()->json([
            'message' => 'Kurs izmenjen',
            'data' => $course
        ]);
    }

    public function destroy(Course $course)
    {
        $course->students()->detach();
        $course->delete();

        return response()->json([
            'message' => 'Kurs obrisan'
        ]);
    }

    public function attachStudent(Request $request, Course $course)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id'
        ]);

        $course->students()->syncWithoutDetaching([$request->student_id]);

        return response()->json([
            'message' => 'Student dodat na kurs'
        ]);
    }

    public function detachStudent(Request $request, Course $course)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id'
        ]);

        $course->students()->detach($request->student_id);

        return response()->json([
            'message' => 'Student uklonjen sa kursa'
        ]);
    }
}
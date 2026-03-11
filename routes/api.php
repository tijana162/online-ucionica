<?php

use App\Http\Controllers\Api\Admin\AdminAuthController;
use App\Http\Controllers\Api\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Api\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Api\Student\AuthController as StudentAuthController;
use App\Http\Controllers\Api\Student\CourseController as StudentCourseController;
use App\Http\Controllers\Api\Admin\AdminController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->group(function () {
    Route::post('/login', [AdminAuthController::class, 'login']);

    Route::middleware(['jwt.auth', 'admin'])->group(function () {
        Route::apiResource('students', AdminStudentController::class);
        Route::apiResource('courses', AdminCourseController::class);
        Route::post('courses/{course}/attach-student', [AdminCourseController::class, 'attachStudent']);
        Route::post('courses/{course}/detach-student', [AdminCourseController::class, 'detachStudent']);
        Route::get('me', [AdminAuthController::class, 'me']);
        Route::post('logout', [AdminAuthController::class, 'logout']);
        Route::post('/admins', [AdminController::class, 'store']);
    });
});

Route::prefix('student')->group(function () {
    Route::post('/register', [StudentAuthController::class, 'register']);
    Route::post('/login', [StudentAuthController::class, 'login']);

    Route::middleware(['jwt.auth', 'student'])->group(function () {
        Route::get('me', [StudentAuthController::class, 'me']);
        Route::apiResource('courses', StudentCourseController::class)->only(['index', 'show']);
        Route::post('courses/{course}/attach', [StudentCourseController::class, 'attach']);
        Route::post('courses/{course}/detach', [StudentCourseController::class, 'detach']);
        Route::get('my-courses', [StudentCourseController::class, 'myCourses']);
        Route::post('logout', [StudentAuthController::class, 'logout']);
    });
});
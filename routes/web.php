<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Student\StudentCourseController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::resource('admins', AdminController::class);
        Route::resource('students', StudentController::class);

        Route::resource('courses', CourseController::class);

    
        Route::post('courses/{course}/attach', [CourseController::class, 'attachStudent'])
            ->name('courses.attachStudent');

        Route::delete('courses/{course}/detach/{student}', [CourseController::class, 'detachStudent'])
            ->name('courses.detachStudent');
    });

Route::middleware(['auth'])->prefix('student')->name('student.')->group(function() {
    Route::get('courses', [StudentCourseController::class, 'index'])->name('courses.index');
    Route::post('courses/{course}/enroll', [StudentCourseController::class, 'enroll'])->name('courses.enroll');
    Route::delete('courses/{course}/unenroll', [StudentCourseController::class, 'unenroll'])->name('courses.unenroll');
});

require __DIR__.'/auth.php';
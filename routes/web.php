<?php

use App\Http\Controllers\Course2Controller;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\InstructorRequestController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LessonController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('front.home.index');
});

Route::get('/home', [PageController::class, 'index'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::prefix('courses')->name('courses.')->group(function () {
    Route::get('/', [Course2Controller::class, 'index_instructor'])->name('index');
    Route::get('/create', [Course2Controller::class, 'create2'])->name('create');
    Route::post('/', [CourseController::class, 'store'])->name('store');
    Route::get('/{course}', [CourseController::class, 'show'])->name('show');
    Route::get('/{course}/edit', [CourseController::class, 'edit'])->name('edit');
    Route::put('/{course}', [CourseController::class, 'update'])->name('update');
    Route::delete('/{course}', [Course2Controller::class, 'destroy'])->name('destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/instructor/request', [InstructorRequestController::class, 'create'])->name('instructor.request.create');
    Route::post('/instructor/request', [InstructorRequestController::class, 'store'])->name('instructor.request.store');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');

    Route::resources(['lesson' => LessonController::class]);

});

//Route::get('/dashboard', function () {
    //return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin-auth.php';

<?php

use App\Http\Controllers\Admin\dashboard\AdminController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\RegisterController;

use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Spatie\PermissionController;
use App\Http\Controllers\Spatie\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('register', [RegisterController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisterController::class, 'store']);

    Route::get('login', [LoginController::class, 'create'])
        ->name('login');

    Route::post('login', [LoginController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [LoginController::class, 'destroy'])
        ->name('logout');

    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::middleware(['auth'])->group(function () {
        Route::resources(['category'=>CategoryController::class]);

        Route::resources(['course' => CourseController::class]);

        Route::get('alluser', [AdminController::class , 'users'])->name('alluser.index');
        Route::get('student' ,[AdminController::class, 'students'])->name('student.index');
        Route::delete('student/{user}', [AdminController::class, 'destroy'])->name('student.destroy');
        Route::get('instructor', [AdminController::class, 'instructors'])->name('instructor.index');
        Route::delete('instructor/{user}', [AdminController::class, 'destroy'])->name('instructor.destroy');

        Route::resources(['permission'=>PermissionController::class]);
        Route::resources(['role'=>RoleController::class]);


        Route::get('rolePermission/{role}', [RoleController::class , 'rolePermission'])->name('rolePermission');
        Route::put('manageRolePermission/{role}', [RoleController::class , 'manageRolePermission'])->name('manageRolePermission');

        Route::get('users', [UserController::class , 'listUsers'])->name('user.list');
        Route::get('userRole/{user}', [UserController::class , 'userRole'])->name('user.userRole');
        Route::put('manageUserRole/{user}', [UserController::class , 'manageUserRole'])->name('manageUserRole');
        Route::delete('users/{user}', [UserController::class , 'destroy'])->name('user.destroy');

    });

});

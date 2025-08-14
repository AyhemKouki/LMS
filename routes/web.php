<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\Course2Controller;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\InstructorRequestController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LessonController;
use App\Livewire\Chat\ChatRoom;
use App\Livewire\Chat\RoomFormManager;
use App\Livewire\Chat\RoomTable;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RatingController;

Route::get('/', function () {
    return view('front.home.index');
});

Route::get('/home', [PageController::class, 'index'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::get('/courses-page', [CourseController::class, 'index2'])->name('coursespage.index');

Route::prefix('courses')->name('courses.')->group(function () {
    Route::get('/', [Course2Controller::class, 'index_instructor'])->name('index');
    Route::get('/create', [Course2Controller::class, 'create2'])->name('create');
    Route::post('/', [CourseController::class, 'store'])->name('store');

    Route::get('/mycourses', [CourseController::class, 'mycourses'])->name('mycourses');
    Route::get('/watchLesson/{lesson}', [CourseController::class, 'watchLesson'])->name('watchLesson');

    Route::get('/{course}', [CourseController::class, 'show'])->name('show');
    Route::get('/{course}/edit', [CourseController::class, 'edit'])->name('edit');
    Route::get('/{course}/edit2', [CourseController::class, 'edit2'])->name('edit2');
    Route::put('/{course}', [CourseController::class, 'update'])->name('update');
    Route::delete('/{course}', [Course2Controller::class, 'destroy'])->name('destroy');

});

Route::middleware('auth')->group(function () {
    Route::get('/instructor/request', [InstructorRequestController::class, 'create'])->name('instructor.request.create');
    Route::post('/instructor/request', [InstructorRequestController::class, 'store'])->name('instructor.request.store');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/instructor_dashboard', [UserController::class, 'instructor_index'])->name('instructor_dashboard');
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');

    Route::resources(['lesson' => LessonController::class]);

    // cart routes
    Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('addToCart');
    Route::get('/cart', [CartController::class, 'cart'])->name('cart');
    Route::post('/order', [CartController::class, 'order'])->name('order.post');
    Route::get('/order-success', [CartController::class, 'orderSuccess'])->name('order.success');
    Route::delete('/remove-from-cart/{id}', [CartController::class, 'removeFromCart'])->name('removeFromCart');


    Route::post('/checkout/{course}/apply-coupon', [CartController::class, 'applyCoupon'])->name('checkout.applyCoupon');


    Route::resources(['orders' => OrderController::class]);


    Route::get('/rooms-table', RoomTable::class)->name('rooms-table');

    Route::get('/room-form-manager/create', RoomFormManager::class)->name('room-form-manager.create');
    Route::get('/room-form-manager/{room}', RoomFormManager::class)->name('room-form-manager.show');
    Route::get('/room-form-manager/{room}/edit', RoomFormManager::class)->name('room-form-manager.edit');

    Route::get('chat-room/{room}' , ChatRoom::class)->name('chat-room');

    Route::get('/course/{course}/chat', [CourseController::class, 'chatWithInstructor'])->name('course.chat');


});

//Route::get('/dashboard', function () {
    //return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// rating routes
Route::middleware('auth')->group(function () {
    Route::post('/courses/{course}/ratings', [RatingController::class, 'store'])->name('ratings.store');
    Route::delete('/courses/{course}/ratings', [RatingController::class, 'destroy'])->name('ratings.destroy');
    Route::get('seeReviews', [RatingController::class, 'seeReviews'])->name('seeReviews');
});

// Routes pour les coupons
Route::middleware(['auth'])->group(function () {
    Route::resource('coupons', CouponController::class);
});

require __DIR__.'/auth.php';
require __DIR__.'/admin-auth.php';

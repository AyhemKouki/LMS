<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class Course2Controller extends Controller
{
    public static function middleware(): array
    {
        return [
            // examples with aliases, pipe-separated names, guards, etc:
            'role_or_permission:manager|edit articles',
            new Middleware('role:author', only: ['index']),

            'role:admin|instructor|student',
            new Middleware('permission: view course ', only: ['index_instructor']),
        ];
    }
    public function __construct()
    {
        Gate::authorize('OnlyInstructor' , User::class);
    }

    public function index_instructor(){
        $courses = Course::where('user_id' , auth()->id())->paginate(5);
        $categories = Category::all();
        return view('courses.index_instructor', compact('courses' , 'categories'));
    }

    public function create2()
    {
        $categories = Category::all();
        return view('courses.create2' , compact('categories'));
    }


    public function destroy(Course $course)
    {
        if($course->thumbnail)
        {
            Storage::delete($course->thumbnail);
        }

        $course->delete();

        flash()->position('bottom-right')->success('Course deleted successfully.');
        return redirect()->route('courses.index');
    }
}

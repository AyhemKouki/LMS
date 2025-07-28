<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class LessonController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('role:admin|instructor|student'),
            new Middleware('permission:view any lesson', only: ['index']),
            new Middleware('permission:view lesson', only: ['show']),
            new Middleware('permission:create lesson', only: ['create' , 'store']),
            new Middleware('permission:destroy lesson', only: ['destroy']),
            new Middleware('permission:edit lesson', only: ['edit' , 'update']),
        ];
    }
    public function __construct(){
        Gate::authorize('OnlyInstructorLesson' , User::class);
    }
    public function index()
    {
        $courses = Course::where('user_id' , auth()->id())->get();
        $lessons = Lesson::where('user_id' , auth()->id())->get();
        return view('lessons.index' , compact('lessons','courses'));
    }


    public function create()
    {
        $courses = Course::where('user_id' , auth()->id())->get();
        return view('lessons.create' , compact('courses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'lesson_order' => 'required|numeric',
            'course_id' => 'required|exists:courses,id',
        ]);
        $data['user_id'] = auth()->id();
        Lesson::create($data);

        flash()->options(["position"=>"bottom-right"])->success('Lesson created successfully.');
        return redirect()->route('lesson.index');

    }

    public function show(Lesson $lesson)
    {
        return view('lessons.show' , compact('lesson'));
    }

    public function edit(Lesson $lesson)
    {
        $courses = Course::where('user_id' , auth()->id())->get();
        return view('lessons.edit' , compact('lesson' , 'courses'));
    }

    public function update(Request $request, Lesson $lesson)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'lesson_order' => 'required|numeric',
            'course_id' => 'required|exists:courses,id',
        ]);

        $lesson->update($data);
        flash()->options(["position" => "bottom-right"])->success('Lesson updated successfully.');
        return redirect()->route('lesson.index');
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        flash()->options(["position" => "bottom-right"])->success('Lesson deleted successfully.');
        return redirect()->route('lesson.index');
    }
}

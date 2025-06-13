<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::paginate(5);
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('courses.create' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:courses,slug|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'duration_hours' => 'required|numeric',
            'level' => 'required|string',
            'status' => 'required|string',
            'price' => 'required|numeric',
            'is_approved' => 'string',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('thumbnail')) {
            $thumbnail = Storage::putFile('public/courses_images', $request->file('thumbnail'));
            $data['thumbnail'] = $thumbnail;
        }

        if (auth()->guard('admin')->check()) {
            $data['admin_id'] = auth()->guard('admin')->id();
            $data['user_id'] = null;
        } else {
            $data['user_id'] = auth()->id();
            $data['admin_id'] = null;
        }

        Course::create($data);

        flash()->position('bottom-right')->success('Course created successfully.');

        if (auth()->guard('admin')->check()) {
            return redirect()->route('admin.course.index');
        }
        else{
            return redirect()->route('courses.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('courses.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $categories = Category::all();
        return view('courses.edit', compact('course','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        if ($request->hasFile('thumbnail')) {
            $request->validate(['thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048']);
            Storage::delete($course->thumbnail);
            $thumbnail = Storage::putFile('public/courses_images', $request->file('thumbnail'));
            $course->update(['thumbnail' => $thumbnail]);
        }
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:courses,slug,' . $course->id . '|max:255',
            'description' => 'nullable|string',
            'duration_hours' => 'required|numeric',
            'level' => 'required|string',
            'status' => 'required|string',
            'price' => 'required|numeric',
            'is_approved' => 'string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $course->update($data);

        flash()->success('Course updated successfully.');

        return redirect()->route('admin.course.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        if($course->thumbnail)
        {
            Storage::delete($course->thumbnail);
        }

        $course->delete();
        flash()->success('Course deleted successfully.');
        return redirect()->route('admin.course.index');
    }
}

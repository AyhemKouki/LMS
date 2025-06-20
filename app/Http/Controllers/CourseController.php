<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Order;
use App\Models\OrderCourse;
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
            'has_certificate' => 'boolean',
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
    public function show(Course $course)
    {
        return view('courses.show' , compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $categories = Category::all();
        return view('courses.edit', compact('course','categories'));
    }

    public function edit2(Course $course)
    {
        $categories = Category::all();
        return view('courses.edit_instructor', compact('course','categories'));
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

        $data['has_certificate'] = $request->has('has_certificate');

        $course->update($data);

        flash()->position('bottom-right')->success('Course updated successfully.');


        if (auth()->guard('admin')->check()) {
            return redirect()->route('admin.course.index');
        }
        else{
            return redirect()->route('courses.index');
        }
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
        flash()->position('bottom-right')->success('Course deleted successfully.');
        return redirect()->route('admin.course.index');
    }

    public function index2(Request $request)
    {
        $query = Course::query();

        // Category filter
        if ($request->filled('categories')) {
            $query->whereIn('category_id', (array)$request->categories);
        }

        // Level filter
        if ($request->filled('levels')) {
            $query->whereIn('level', (array)$request->levels);
        }

        // Price range filter
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        // Rating filter (i didnt implement rating yet)
        if ($request->filled('min_rating')) {
            $query->whereHas('reviews', function($q) use ($request) {
                $q->havingRaw('AVG(rating) >= ?', [$request->min_rating]);
            });
        }

        $courses = $query->paginate(12); // Use pagination for better performance
        $categories = Category::all();

        return view('front.pages.course', compact('courses', 'categories'));
    }


    public function mycourses()
    {
        $orders = Order::where('user_id', auth()->id())->get();
        $courses = collect();

        foreach ($orders as $order) {
            $orderCourses = OrderCourse::where('order_id', $order->id)
                ->with('course')
                ->get()
                ->pluck('course');
            $courses = $courses->concat($orderCourses);
        }

        return view('users.user.course.mycourses', compact('courses'));
    }

    public function watchLesson(Lesson $lesson)
    {
        return view('users.user.course.watchLesson' , compact('lesson'));
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request, Course $course)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000'
        ]);

        Rating::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'course_id' => $course->id
            ],
            [
                'rating' => $request->rating,
                'comment' => $request->comment
            ]
        );

        flash()->options(['position' => 'bottom-right'])->success('Your rating has been submitted.');
        return redirect()->back();
    }

    public function destroy(Course $course)
    {
        Rating::where('user_id', Auth::id())
              ->where('course_id', $course->id)
              ->delete();

        flash()->options(['position' => 'bottom-right'])->success('Your rating has been deleted.');
        return redirect()->back();
    }
}

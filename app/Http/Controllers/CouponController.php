<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Course;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::where('user_id', auth()->id())->get();

        return view('coupons.index', compact('coupons'));
    }

    public function create()
    {

        $courses = Course::where('user_id' , auth()->id())->get();

        return view('coupons.create' , compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'coupon_name' => 'required|string|max:255',
            'coupon_discount' => 'required|string|max:10',
            'coupon_validity' => 'required|date|after:today',
            'course_id' => 'nullable|exists:courses,id',
            'status' => 'required|in:0,1',
        ]);

        $validated['user_id'] = auth()->id();

        Coupon::create($validated);

        flash()->options(["position"=>"bottom-right"])->success("Coupon created successfully.");

        return redirect()->route('coupons.index');
    }

    public function edit(Coupon $coupon)
    {
        $courses = Course::where('user_id', auth()->id())->get();
        return view('coupons.edit', compact('coupon', 'courses'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $validated = $request->validate([
            'coupon_name' => 'required|string|max:255',
            'coupon_discount' => 'required|string|max:10',
            'coupon_validity' => 'required|date|after:today',
            'course_id' => 'nullable|exists:courses,id',
            'status' => 'required|in:0,1',
        ]);

        $coupon->update($validated);

        flash()->options(["position"=>"bottom-right"])->success("Coupon updated successfully.");
        return redirect()->route('coupons.index');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();


        flash()->options(["position"=>"bottom-right"])->success("Coupon deleted successfully.");
        return redirect()->route('coupons.index');
    }
}

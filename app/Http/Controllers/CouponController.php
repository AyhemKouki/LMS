<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CouponController extends Controller
{
    public function index()
    {

        $user = auth()->user();

        if ($user->role === 'instructor') {

            $coupons = Coupon::where('user_id', auth()->id())->get();

            return view('coupons.index', compact('coupons'));
        }
        else{
            $coupons = Coupon::get();
            return view('users.admin.coupon.index', compact('coupons'));
        }

    }

    public function create()
    {

        $user = auth()->user();
        if ($user->role === 'instructor') {
            $courses = Course::where('user_id' , auth()->id())->get();
            return view('coupons.create' , compact('courses'));
        }
        else{
            $courses = Course::get();
            return view('users.admin.coupon.create', compact('courses'));
        }


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



        $user = auth()->user();
        if ($user->role === 'instructor') {

            $validated['user_id'] = auth()->id();

            Coupon::create($validated);

            flash()->options(["position"=>"bottom-right"])->success("Coupon created successfully.");
            return redirect()->route('coupons.index');
        }
        else{
            $validated['admin_id'] = auth()->id();

            Coupon::create($validated);

            flash()->options(["position"=>"bottom-right"])->success("Coupon created successfully.");
            return redirect()->route('admin.coupons.create');
        }

    }

    public function edit(Coupon $coupon)
    {
        $user = auth()->user();
        if ($user->role === 'instructor') {
            $courses = Course::where('user_id', auth()->id())->get();
            return view('coupons.edit', compact('coupon', 'courses'));
        }
        else{
            $courses = Course::get();
            return view('users.admin.coupon.edit', compact('coupon', 'courses'));
        }

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

        $user = auth()->user();
        if ($user->role === 'instructor') {
            return redirect()->route('coupons.index');
        }
        else {
            return redirect()->route('admin.coupons.index');
        }
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();


        flash()->options(["position"=>"bottom-right"])->success("Coupon deleted successfully.");

        if (auth()->user()->role === 'instructor') {
            return redirect()->route('coupons.index');
        }
        else {
            return redirect()->route('admin.coupons.index');
        }
    }
}

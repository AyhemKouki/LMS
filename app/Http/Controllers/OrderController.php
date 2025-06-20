<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderCourse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->user()->id)->latest()->get();
        $order_courses = [];
        foreach ($orders as $order) {
            $order_courses = array_merge($order_courses , OrderCourse::where('order_id', $order->id)->get()->all());
        }

        return view('users.user.order.index' , compact('orders' , 'order_courses'));
    }
}

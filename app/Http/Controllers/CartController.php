<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Course;
use App\Models\Order;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function addToCart(Request $request , $id)
    {
        $course = Course::find($id);
        $cart = session('cart' , []);
        $cart[$id] = [
            "name" => $course->title,
            "quantity" => 1,
            "price" => $course->price,
            "original_price" => $course->price,
            "image" => $course->thumbnail,
            "description" => $course->description,
        ];
        session()->put('cart' , $cart);
        flash()->options(["position" => "bottom-right"])->success('Course added to cart successfully.');
        return redirect()->back();
    }

    public function cart(Request $request)
    {
        return view('cart');
    }

    public function removeFromCart(string $id)
    {
        $cart = session('cart' , []);
        unset($cart[$id]);
        session()->put('cart' , $cart);
        return redirect()->back();
    }

    public function order(Request $request)
    {
        $order = Order::create([
            'user_id' => auth()->id()
        ]);

        $amount = 0;
        foreach (session('cart') as $key => $value) {
            $price = $value['price'];
            $order->courses()->create([
                'course_id' => $key,
                'quantity' => $value['quantity'],
                'price' => $price,
            ]);
            $amount += $price * $value['quantity'];
        }

        $order->amount = $amount;
        $order->save();

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $success_url = route('order.success').'?session_id={CHECKOUT_SESSION_ID}&order_id='.$order->id;

        $response = $stripe->checkout->sessions->create([
            'success_url' => $success_url,
            "customer_email" => auth()->user()->email,
            'line_items' => [
                [
                    'price_data' => [
                        "product_data" =>[
                            "name" => "LMS"
                        ],
                        'unit_amount' => $amount * 100,
                        'currency' => 'USD',
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
        ]);

        return redirect($response['url']);

    }

    public function orderSuccess(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $session = $stripe->checkout->sessions->retrieve($request->session_id);

        if ($session->status == 'complete') {
            $order = Order::find($request->order_id);
            $order->status = 1;
            $order->stripe_id = $session->id;
            $order->save();

            session()->forget('cart');

            flash()->options(["position" => "bottom-right"])->success('Order placed successfully.');
            return redirect()->route('coursespage.index');
        }

        $order = Order::find($request->order_id);
        $order->status = 2;
        $order->save();

        dd('Payment failed');

    }

    public function applyCoupon(Request $request, Course $course)
    {
        $request->validate([
            'coupon_code' => 'required|string|exists:coupons,coupon_name',
        ]);

        $coupon = Coupon::active()
            ->where('coupon_name', $request->coupon_code)
            ->first();

        if (!$coupon) {
            return back()->withErrors(['coupon_code' => 'Ce coupon n’est pas valide ou a expiré.']);
        }

        if (!$coupon->isApplicableForCourse($course->id)) {
            return back()->withErrors(['coupon_code' => 'Ce coupon ne s’applique pas à ce cours.']);
        }

        $cart = session('cart');
        foreach ($cart as $id => &$item) {
            if ($id == $course->id) {
                $discountedPrice = $coupon->applyDiscount($item['original_price']);
                $item['price'] = $discountedPrice;
                session(['discounted_price' => $discountedPrice]);
            }
        }
        session(['cart' => $cart]);
        session(['applied_coupon' => $coupon->id]);

        flash()->options(["position" => "bottom-right"])->success('Coupon applied successfully.');
        return redirect()->route('cart');
    }



}

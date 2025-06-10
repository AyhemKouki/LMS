<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function index()
    {
        return view('front.home.index');

    }
    public function about() {
        return view('front.pages.about');
    }

    public function contact() {
        return view('front.pages.contactus');
    }
}

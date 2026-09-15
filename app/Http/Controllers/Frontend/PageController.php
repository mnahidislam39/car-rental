<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;

class PageController extends Controller
{
    public function home() {
        $featuredCars = Car::where('availability', true)->latest()->take(6)->get();
        return view('frontend.home', compact('featuredCars'));
    }

    public function about() {
        return view('frontend.about');
    }

    public function contact() {
        return view('frontend.contact');
    }
}

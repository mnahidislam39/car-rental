<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request) {
        $query = Car::where('availability', true);

        // Filter by Car Type
        if ($request->filled('car_type')) {
            $query->where('car_type', $request->car_type);
        }

        // Filter by Brand
        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }

        // Filter by Max Price
        if ($request->filled('max_price')) {
            $query->where('daily_rent_price', '<=', $request->max_price);
        }

        $cars = $query->paginate(9);
        $brands = Car::select('brand')->distinct()->pluck('brand');
        $carTypes = Car::select('car_type')->distinct()->pluck('car_type');

        return view('frontend.cars.index', compact('cars', 'brands', 'carTypes'));
    }

    public function show(Car $car) {
        return view('frontend.cars.show', compact('car'));
    }
}

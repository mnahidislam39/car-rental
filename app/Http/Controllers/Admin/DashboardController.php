<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCars = Car::count();
        $availableCars = Car::where('availability', true)->count();
        $totalRentals = Rental::count();
        $totalEarnings = Rental::where('status', '!=', 'canceled')->sum('total_cost');

        return view('admin.dashboard', compact('totalCars', 'availableCars', 'totalRentals', 'totalEarnings'));
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;
use App\Models\User;
use App\Mail\RentalConfirmationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class RentalController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        $car = Car::findOrFail($request->car_id);

        // Check if car is already rented for selected dates
        $exists = Rental::where('car_id', $car->id)
            ->where('status', '!=', 'canceled')
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                      ->orWhereBetween('end_date', [$request->start_date, $request->end_date]);
            })->exists();

        if ($exists) {
            return back()->with('error', 'Car is not available for the selected dates.');
        }

        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);
        $days = $start->diffInDays($end) ?: 1;
        $totalCost = $days * $car->daily_rent_price;

        $rental = Rental::create([
            'user_id' => Auth::id(),
            'car_id' => $car->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_cost' => $totalCost,
            'status' => 'Ongoing'
        ]);

        // Send Email to Customer & Admin
        Mail::to(Auth::user()->email)->send(new RentalConfirmationMail($rental));
        $admin = User::where('role', 'admin')->first();
        if ($admin) {
            Mail::to($admin->email)->send(new RentalConfirmationMail($rental));
        }

        return redirect()->route('my.bookings')->with('success', 'Booking confirmed successfully!');
    }

    public function myBookings()
    {
        $rentals = Rental::where('user_id', Auth::id())->with('car')->latest()->get();
        return view('frontend.rentals.my_bookings', compact('rentals'));
    }

    public function cancel($id)
    {
        $rental = Rental::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if (Carbon::now()->gte(Carbon::parse($rental->start_date))) {
            return back()->with('error', 'You cannot cancel a rental that has already started.');
        }

        $rental->update(['status' => 'canceled']);
        return back()->with('success', 'Booking canceled successfully.');
    }
}

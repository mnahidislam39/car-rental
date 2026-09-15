<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;
use App\Mail\RentalConfirmationMail;
use App\Mail\AdminRentalNotificationMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RentalController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        // Check availability (Overlapping booking check)
        $isBooked = Rental::where('car_id', $request->car_id)
            ->where('status', '!=', 'Canceled')
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                      ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                      ->orWhere(function ($q) use ($request) {
                          $q->where('start_date', '<=', $request->start_date)
                            ->where('end_date', '>=', $request->end_date);
                      });
            })->exists();

        if ($isBooked) {
            return back()->withErrors(['message' => 'Car is already booked for the selected dates.']);
        }

        $car = Car::findOrFail($request->car_id);
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $days = $startDate->diffInDays($endDate) ?: 1;
        $totalCost = $days * $car->daily_rent_price;

        $rental = Rental::create([
            'user_id' => auth()->id(),
            'car_id' => $car->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_cost' => $totalCost,
            'status' => 'Ongoing'
        ]);

        // Send Email Notifications (Section 8 Trigger)
        try {
            Mail::to(auth()->user()->email)->send(new RentalConfirmationMail($rental));
            Mail::to('admin@carrental.com')->send(new AdminRentalNotificationMail($rental));
        } catch (\Exception $e) {
            // Log mail error if mail server is not configured locally
        }

        return redirect()->route('rentals.my_bookings')->with('success', 'Car booked successfully via By Cash payment mode!');
    }

    public function myBookings() {
        $rentals = Rental::where('user_id', auth()->id())->with('car')->latest()->paginate(10);
        return view('frontend.rentals.my_bookings', compact('rentals'));
    }

    public function cancel(Rental $rental) {
        if ($rental->user_id !== auth()->id()) {
            abort(403);
        }

        // Allow cancellation only if rental has not started yet
        if (Carbon::now()->lt(Carbon::parse($rental->start_date)) && $rental->status === 'Ongoing') {
            $rental->update(['status' => 'Canceled']);
            return back()->with('success', 'Booking canceled successfully.');
        }

        return back()->withErrors(['message' => 'Cannot cancel an ongoing or past rental.']);
    }
}

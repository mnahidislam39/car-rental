<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index() {
        $rentals = Rental::with(['user', 'car'])->latest()->paginate(10);
        return view('admin.rentals.index', compact('rentals'));
    }

    public function update(Request $request, Rental $rental) {
        $request->validate([
            'status' => 'required|in:Ongoing,Completed,Canceled',
        ]);

        $rental->update(['status' => $request->status]);
        return back()->with('success', 'Rental status updated successfully.');
    }

    public function destroy(Rental $rental) {
        $rental->delete();
        return back()->with('success', 'Rental deleted successfully.');
    }
}

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CarController as AdminCarController;
use App\Http\Controllers\Admin\RentalController as AdminRentalController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\CarController as FrontCarController;
use App\Http\Controllers\Frontend\RentalController as FrontRentalController;

// Admin Routes (Protected by auth and admin middleware)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Stats
    Route::get('/dashboard', function () {
        $totalCars = \App\Models\Car::count();
        $availableCars = \App\Models\Car::where('availability', true)->count();
        $totalRentals = \App\Models\Rental::count();
        $totalEarnings = \App\Models\Rental::where('status', '!=', 'Canceled')->sum('total_cost');

        return view('admin.dashboard', compact('totalCars', 'availableCars', 'totalRentals', 'totalEarnings'));
    })->name('dashboard');

    // Manage Cars (CRUD)
    Route::resource('cars', AdminCarController::class);

    // Manage Rentals
    Route::resource('rentals', AdminRentalController::class);

    // Manage Customers
    Route::get('/customers', [AdminCustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/{id}', [AdminCustomerController::class, 'show'])->name('customers.show');
});



// Public Routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// Car Listing & Details
Route::get('/cars', [FrontCarController::class, 'index'])->name('cars.index');
Route::get('/cars/{car}', [FrontCarController::class, 'show'])->name('cars.show');

// Customer Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::post('/rentals', [FrontRentalController::class, 'store'])->name('rentals.store');
    Route::get('/my-bookings', [FrontRentalController::class, 'myBookings'])->name('rentals.my_bookings');
    Route::post('/rentals/{rental}/cancel', [FrontRentalController::class, 'cancel'])->name('rentals.cancel');
});

require __DIR__.'/auth.php';

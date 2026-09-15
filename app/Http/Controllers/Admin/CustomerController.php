<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class CustomerController extends Controller
{
    public function index() {
        $customers = User::where('role', 'customer')->withCount('rentals')->latest()->paginate(10);
        return view('admin.customers.index', compact('customers'));
    }

    public function show($id) {
        $customer = User::where('role', 'customer')->with('rentals.car')->findOrFail($id);
        return view('admin.customers.show', compact('customer'));
    }
}

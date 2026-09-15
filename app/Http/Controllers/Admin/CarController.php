<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index() {
        $cars = Car::latest()->paginate(10);
        return view('admin.cars.index', compact('cars'));
    }

    public function create() {
        return view('admin.cars.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string',
            'brand' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|integer',
            'car_type' => 'required|string',
            'daily_rent_price' => 'required|numeric',
            'availability' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('cars', 'public');
        }

        Car::create($data);
        return redirect()->route('admin.cars.index')->with('success', 'Car added successfully.');
    }

    public function edit(Car $car) {
        return view('admin.cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car) {
        $data = $request->validate([
            'name' => 'required|string',
            'brand' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|integer',
            'car_type' => 'required|string',
            'daily_rent_price' => 'required|numeric',
            'availability' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($car->image) {
                Storage::disk('public')->delete($car->image);
            }
            $data['image'] = $request->file('image')->store('cars', 'public');
        }

        $car->update($data);
        return redirect()->route('admin.cars.index')->with('success', 'Car updated successfully.');
    }

    public function destroy(Car $car) {
        if ($car->image) {
            Storage::disk('public')->delete($car->image);
        }
        $car->delete();
        return redirect()->route('admin.cars.index')->with('success', 'Car deleted successfully.');
    }
}

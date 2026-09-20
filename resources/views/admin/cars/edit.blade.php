<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Car</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h2>Edit Car Details</h2>

    <form action="{{ route('admin.cars.update', $car->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm mt-3">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Car Name</label>
                <input type="text" name="name" value="{{ old('name', $car->name) }}" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Brand</label>
                <input type="text" name="brand" value="{{ old('brand', $car->brand) }}" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Model</label>
                <input type="text" name="model" value="{{ old('model', $car->model) }}" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Year</label>
                <input type="number" name="year" value="{{ old('year', $car->year) }}" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Car Type</label>
                <input type="text" name="car_type" value="{{ old('car_type', $car->car_type) }}" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Daily Rent Price ($)</label>
                <input type="number" step="0.01" name="daily_rent_price" value="{{ old('daily_rent_price', $car->daily_rent_price) }}" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Availability</label>
                <select name="availability" class="form-select">
                    <option value="1" {{ $car->availability ? 'selected' : '' }}>Available</option>
                    <option value="0" {{ !$car->availability ? 'selected' : '' }}>Not Available</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label>Car Image</label>
                <input type="file" name="image" class="form-control">
                @if($car->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $car->image) }}" alt="Car Image" width="80" class="rounded">
                    </div>
                @endif
            </div>
        </div>

        <button type="submit" class="btn btn-warning">Update Car</button>
        <a href="{{ route('admin.cars.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>

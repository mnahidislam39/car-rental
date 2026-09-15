<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Car</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h2>Add New Car</h2>
    <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Car Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Brand</label>
                <input type="text" name="brand" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Model</label>
                <input type="text" name="model" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Year</label>
                <input type="number" name="year" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Car Type (SUV, Sedan, etc.)</label>
                <input type="text" name="car_type" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Daily Rent Price</label>
                <input type="number" step="0.01" name="daily_rent_price" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Availability</label>
                <select name="availability" class="form-select">
                    <option value="1">Available</option>
                    <option value="0">Not Available</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label>Car Image</label>
                <input type="file" name="image" class="form-control">
            </div>
        </div>
        <button type="submit" class="btn btn-success">Save Car</button>
        <a href="{{ route('admin.cars.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>

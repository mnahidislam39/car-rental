<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Cars - Car Rental</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">CarRental</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('cars.index') }}">Cars</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <h2 class="mb-4 fw-bold">Browse All Available Cars</h2>

        <!-- Filter Form -->
        <div class="card p-4 shadow-sm mb-4">
            <form action="{{ route('cars.index') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label font-weight-bold">Brand</label>
                    <input type="text" name="brand" class="form-control" placeholder="e.g. Toyota, BMW" value="{{ request('brand') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label font-weight-bold">Car Type</label>
                    <select name="car_type" class="form-select">
                        <option value="">All Types</option>
                        <option value="Sedan" {{ request('car_type') == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                        <option value="SUV" {{ request('car_type') == 'SUV' ? 'selected' : '' }}>SUV</option>
                        <option value="Hatchback" {{ request('car_type') == 'Hatchback' ? 'selected' : '' }}>Hatchback</option>
                        <option value="Luxury" {{ request('car_type') == 'Luxury' ? 'selected' : '' }}>Luxury</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label font-weight-bold">Max Daily Rent ($)</label>
                    <input type="number" name="max_price" class="form-control" placeholder="e.g. 150" value="{{ request('max_price') }}">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Apply Filter</button>
                </div>
            </form>
        </div>

        <!-- Car Listing Grid -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @forelse($cars as $car)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ $car->image ? asset('storage/' . $car->image) : 'https://via.placeholder.com/300x200?text=No+Image' }}"
                             class="card-img-top object-fit-cover"
                             alt="{{ $car->name }}"
                             style="height: 200px; width: 100%;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold mb-1">{{ $car->name }}</h5>
                            <p class="card-text text-muted mb-1"><strong>Brand:</strong> {{ $car->brand }} | <strong>Type:</strong> {{ $car->car_type }}</p>
                            <p class="card-text text-primary fs-5 fw-bold mb-3">
                                ${{ number_format($car->daily_rent_price, 2) }} <small class="fs-6 text-muted">/ day</small>
                            </p>
                            <a href="{{ route('cars.show', $car->id) }}" class="btn btn-primary mt-auto w-100">Book Now</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning text-center">No cars match your search criteria.</div>
                </div>
            @endforelse
        </div>
    </div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $car->name }} - Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <a href="/" class="btn btn-outline-secondary mb-4">&larr; Back to Cars</a>

    <div class="row bg-white p-4 rounded shadow-sm">
        <div class="col-md-6 mb-3 mb-md-0">
            <img src="{{ $car->image ? asset('storage/' . $car->image) : 'https://via.placeholder.com/500x350?text=No+Image' }}"
                 class="img-fluid rounded w-100 object-fit-cover"
                 style="max-height: 350px;"
                 alt="{{ $car->name }}">
        </div>
        <div class="col-md-6">
            <h2>{{ $car->name }}</h2>
            <p class="text-muted mb-2"><strong>Brand:</strong> {{ $car->brand }} | <strong>Model:</strong> {{ $car->model }} ({{ $car->year }})</p>
            <h4 class="text-primary mb-3">${{ $car->daily_rent_price }} <small class="text-muted">/ day</small></h4>
            <p><strong>Type:</strong> {{ $car->car_type }}</p>
            <p><strong>Status:</strong>
                <span class="badge {{ $car->availability ? 'bg-success' : 'bg-danger' }}">
                    {{ $car->availability ? 'Available' : 'Not Available' }}
                </span>
            </p>

            @if($car->availability)
                <form action="{{ route('rentals.store') }}" method="POST" class="mt-4">
                    @csrf
                    <input type="hidden" name="car_id" value="{{ $car->id }}">
                    <div class="mb-3">
                        <label class="form-label">Start Date</label>
                        <input type="date" name="start_date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">End Date</label>
                        <input type="date" name="end_date" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Confirm Booking</button>
                </form>
            @else
                <button class="btn btn-secondary w-100 mt-4" disabled>Currently Unavailable</button>
            @endif
        </div>
    </div>
</div>
</body>
</html>

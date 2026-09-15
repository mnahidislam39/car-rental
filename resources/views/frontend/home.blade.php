<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="mb-4">Welcome to Car Rental</h1>
        <div class="row">
            @forelse($featuredCars as $car)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if($car->image)
                            <img src="{{ asset('storage/' . $car->image) }}" class="card-img-top" alt="{{ $car->name }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $car->name }}</h5>
                            <p class="card-text"><strong>Brand:</strong> {{ $car->brand }}</p>
                            <p class="card-text"><strong>Daily Rent:</strong> ${{ $car->daily_rent_price }}</p>
                            <a href="#" class="btn btn-primary">Book Now</a>
                        </div>
                    </div>
                </div>
            @empty
                <p>No cars available right now.</p>
            @endforelse
        </div>
    </div>
</body>
</html>

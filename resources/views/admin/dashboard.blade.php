<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Car Rental</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h2 class="mb-4">Admin Dashboard Overview</h2>

        <div class="row">
            <!-- Total Cars -->
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Cars</h5>
                        <p class="card-text fs-3">{{ $totalCars }}</p>
                    </div>
                </div>
            </div>

            <!-- Available Cars -->
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Available Cars</h5>
                        <p class="card-text fs-3">{{ $availableCars }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Rentals -->
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Rentals</h5>
                        <p class="card-text fs-3">{{ $totalRentals }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Earnings -->
            <div class="col-md-3">
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Earnings</h5>
                        <p class="card-text fs-3">${{ $totalEarnings }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('admin.cars.index') }}" class="btn btn-outline-primary">Manage Cars</a>
            <a href="{{ route('admin.rentals.index') }}" class="btn btn-outline-success">Manage Rentals</a>
            <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-dark">Manage Customers</a>
        </div>
    </div>
</body>
</html>

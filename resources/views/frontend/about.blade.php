<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Car Rental</title>
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('cars.index') }}">Cars</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('about') }}">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row align-items-center bg-white p-4 rounded shadow-sm">
            <div class="col-md-6">
                <h2 class="fw-bold mb-3">About Our Car Rental System</h2>
                <p class="text-muted">Welcome to our reliable car rental service. We offer a wide range of vehicles, from economical sedans to luxury SUVs, ensuring a seamless and affordable travel experience for all our customers.</p>
                <p class="text-muted">Our platform allows quick bookings, transparent daily rates, and hassle-free cash payment options upon confirmation.</p>
                <a href="{{ route('cars.index') }}" class="btn btn-primary mt-2">Explore Our Fleet</a>
            </div>
            <div class="col-md-6 text-center">
                <img src="https://via.placeholder.com/500x300?text=Car+Rental+About+Us" class="img-fluid rounded shadow-sm" alt="About Us">
            </div>
        </div>
    </div>

</body>
</html>

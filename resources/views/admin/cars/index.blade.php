<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Cars</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Cars List</h2>
        <div>
            <a href="{{ route('admin.cars.create') }}" class="btn btn-primary">+ Add New Car</a>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Dashboard</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Year</th>
                <th>Price/Day</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cars as $car)
            <tr>
                <td>{{ $car->id }}</td>
                <td>{{ $car->name }}</td>
                <td>{{ $car->brand }}</td>
                <td>{{ $car->model }}</td>
                <td>{{ $car->year }}</td>
                <td>${{ $car->daily_rent_price }}</td>
                <td>
                    <span class="badge {{ $car->availability ? 'bg-success' : 'bg-danger' }}">
                        {{ $car->availability ? 'Available' : 'Not Available' }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.cars.edit', $car->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.cars.destroy', $car->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this car?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $cars->links() }}
</div>
</body>
</html>

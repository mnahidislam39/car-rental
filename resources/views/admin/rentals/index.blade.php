<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Rentals</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Rentals List</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Dashboard</a>
    </div>

    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Car Details</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Total Cost</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rentals as $rental)
            <tr>
                <td>{{ $rental->id }}</td>
                <td>{{ $rental->user->name ?? 'N/A' }}</td>
                <td>{{ $rental->car->name ?? 'N/A' }} ({{ $rental->car->brand ?? '' }})</td>
                <td>{{ $rental->start_date }}</td>
                <td>{{ $rental->end_date }}</td>
                <td>${{ $rental->total_cost }}</td>
                <td>
                    <span class="badge bg-info">{{ $rental->status }}</span>
                </td>
                <td>
                    <form action="{{ route('admin.rentals.update', $rental->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <select name="status" onchange="this.form.submit()" class="form-select form-select-sm d-inline-block w-auto">
                            <option value="Ongoing" {{ $rental->status == 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
                            <option value="Completed" {{ $rental->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                            <option value="Canceled" {{ $rental->status == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                        </select>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $rentals->links() }}
</div>
</body>
</html>

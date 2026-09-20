<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>My Bookings</h2>
        <a href="{{ route('cars.index') }}" class="btn btn-primary">Book Another Car</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="table-responsive bg-white p-3 rounded shadow-sm">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Car</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Total Cost</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rentals as $rental)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $rental->car->name ?? 'N/A' }}</td>
                        <td>{{ $rental->start_date }}</td>
                        <td>{{ $rental->end_date }}</td>
                        <td>${{ number_format($rental->total_cost, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ strtolower($rental->status) == 'completed' ? 'success' : (strtolower($rental->status) == 'canceled' ? 'danger' : 'warning') }}">
                                {{ ucfirst($rental->status) }}
                            </span>
                        </td>
                        <td>
                            @if(strtolower($rental->status) != 'canceled' && \Carbon\Carbon::now()->lt(\Carbon\Carbon::parse($rental->start_date)))
                                <form action="{{ route('rentals.cancel', $rental->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this booking?')">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Cancel</button>
                                </form>
                            @else
                                <span class="text-muted small">N/A</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">No bookings found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Customers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Customers List</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Dashboard</a>
    </div>

    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Total Rentals</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                <td>{{ $customer->id }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->rentals_count }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $customers->links() }}
</div>
</body>
</html>

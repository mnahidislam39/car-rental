<h2>New Car Booking Notification</h2>
<p>Customer <strong>{{ $rental->user->name }}</strong> ({{ $rental->user->email }}) has booked a car.</p>
<p><strong>Car Name:</strong> {{ $rental->car->name }}</p>
<p><strong>Rental Period:</strong> {{ $rental->start_date }} to {{ $rental->end_date }}</p>
<p><strong>Total Earnings:</strong> ${{ $rental->total_cost }}</p>
